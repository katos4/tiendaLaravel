<?php

namespace App\Http\Controllers;
 
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
 
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException; // <---
use Illuminate\Support\Facades\Input;
use App\Order;
use App\OrderItem;

use Cart;
use Session;
use App\Producto;
use App\Categoria;
use App\Pedidos;
use App\User;
use App\PedidoProducto;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PaypalController extends BaseController{
	private $_api_context;
 
	public function __construct(){
		// setup PayPal api context
        $paypal_conf = \Config::get('paypal');
        //$paypal_conf = config('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
 
	public function postPayment(){
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
 
		$items = array();
		$subtotal = 0;
       // $cart = \Session::get('cart');
        $cart = Cart::content(); 
		$currency = 'EUR';
        $total = Cart::total();
		foreach($cart as $producto){
			$item = new Item();
			$item->setName($producto->name)
			->setCurrency($currency)
			->setDescription(' ')
			->setQuantity($producto->qty)
			->setPrice($producto->price);
 
			$items[] = $item;
           $subtotal += $producto->qty * $producto->price;
           
		}
 
		$item_list = new ItemList();
		$item_list->setItems($items);
 
		$details = new Details();
		$details->setSubtotal($subtotal)
		->setShipping(3);
 
		$total = $subtotal + 3;
 
		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);
 
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Pedido de prueba en mi Laravel App Store');
 
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.status'))
			->setCancelUrl(\URL::route('payment.status'));
 
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
 
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Ups! Algo salió mal');
			}
		}
 
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
 
		// add payment ID to session
		Session::put('paypal_payment_id', $payment->getId());
 
		if(isset($redirect_url)) {
			// redirect to paypal
            return \Redirect::away($redirect_url);
            //return redirect::away($redirect_url);
		}
 
		return redirect('carrito')
			->with('message', 'Ups! Error desconocido.');
 
	}
 

	public function getPaymentStatus(){
		// Get the payment ID before session clear
       // $payment_id = Session::get('paypal_payment_id');
        $payment_id = $_GET['paymentId'];
 
		// clear the session payment ID
		\Session::forget('paypal_payment_id');
 
		$payerId = Input::get('PayerID');
		$token = Input::get('token');
 
		if (empty($payerId) || empty($token)) {
			return redirect('/')
				->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}
 
		$payment = Payment::get($payment_id, $this->_api_context);
 
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
 
		$result = $payment->execute($execution, $this->_api_context);
 
 
		if ($result->getState() == 'approved') {
 
			
            $this->crearPedido();
			
 
			return redirect('/')
				->with('message', 'Compra realizada de forma correcta');
		}
		    return redirect('/')
			    ->with('message', 'La compra fue cancelada');
	}
 

    public function crearPedido(){
        $fecha = date("d-m-Y");
        $total = Cart::subtotal();
        $idUser = Auth()->user()->id;
        $nombreUser = Auth()->user()->name;
        $emailUser = Auth()->user()->email;
        $direccion='calle de prueba';
        $cp='21003';
        $tablaCategorias = Categoria::get();
        $datosUser=User::where('id',$idUser)->get();

        foreach($datosUser as $dato){
        $arrayDatos = [
            "direccion" => $dato['direccion'],
            "nombre_user" => $nombreUser, 
            "email_user" => $emailUser,
            "total" => $total,
            "estado"=>0,
            "contenidoCarrito" => Cart::content()
        ];
    }

        //envia email y adjunta PDF
          $pdf = PDF::loadView('mail', $arrayDatos);

          Mail::send('mail', $arrayDatos, function($message) use ($pdf) {
            $message->from('gregfdez077@gmail.com','Resumen del pedido');
            $message->to('gregoharriero@gmail.com', 'Grego')
                    ->subject('Factura pedido MyTotem');
            $message -> attachData($pdf->output(), 'Resumen_Pedido.pdf');
            
            });
       
        //inserta los datos del pedido en la tabla pedidos
        
        $pedido = Pedidos::create(["user_id" =>$idUser, "fecha_realizacion" =>$fecha, "direccion" =>$direccion, "codigo" =>$cp, "nombre_user" => $nombreUser, "email_user" =>$emailUser ]);
       
        /*coge el id del ultimo pedido insertado, saca los datos de cada item del carrito y los inserta
        en la tabla pedido_has_producto*/
        $id=$pedido->id; 
  
        foreach(Cart::content() as $item){
           
            PedidoProducto::create(["cantidad" =>Cart::get($item->rowId)->qty, 
            "precio" =>Cart::get($item->rowId)->price, 
            "descuento"=>0, 
            "pedido_id"=>$id, 
            "productos_id" =>Cart::get( $item->rowId)->id ]);
          }

          Cart::destroy();

    }



}
