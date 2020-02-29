@extends('master')
@section('content')

<div class="row mt-4">

    <div class="col-md-7">
      <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Producto</th>
            <th scope="col">Precio/Unidad</th> 
            <th scope="col">Cantidad</th>                           
        </tr>
        </thead>
        @foreach(Cart::content() as $item)
                    
          <tbody>
          <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->qty}}</td>
          </tr>
          
          </tbody>
          
        @endforeach
      </table>
   
    <a href="{{ route('payment') }}" class="btn btn-warning">
      Pagar con Paypal<i class="fab fa-paypal"></i>
  </a>
    </div>

    <div class="col-md-5">
      <span><b>Total: </b>{{Cart::subtotal()}} €</span><br>
      <span>Gastos de envio: 3€</span><br>
    </div>

</div>




@endsection