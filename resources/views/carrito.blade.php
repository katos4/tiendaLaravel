@extends('master')
@section('content')

        <div class="row mt-5">

            <h3 class="col-lg-12">  Vista del carrito calvo </h3>
        <h6 class="col-lg-12">Tienes {{Cart::count()}} items en el carrito!</h6>
                <div class="col-lg-8">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio/Unidad</th>                            
                        </tr>
                        </thead>

                    @foreach(Cart::content() as $item)
                    
                        <tbody>
                        <tr>
                            <td> 
                              
                                    <form  action="{{url('/actualizar')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$item->rowId}}" name="id" id="id">
                            
                                        <div class="row">
                                                <div class="col-lg-4">
                                                    <input class="form-control" type="number" value="{{$item->qty}}" id="cantidad" name="cantidad">
                                                
                                                </div>
                                                <div class="col-lg-2" >
                                                    <input type="image" src="http://localhost/tiendaLaravel/public/imagenes/update.png" width="30px" heigth="30px">
                                                </div>
                                        </div>

                                    </form>
                                  
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            
                            <td>
                                <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="row">
                                        
                                        <div class="col-lg-4">
                                            <input type="image" src="http://localhost/tiendaLaravel/public/imagenes/cruzar.png" width="20px" heigth="20px">
                                        </div>
                                    </div>
                                </form>
                             
                            </td>
                        </tr>
                        </tbody>
                    
                    @endforeach
                    </table>
            </div>   
            <div class="col-lg-4">
                <div class="card border-0">
                    <div class="card-header">({{Cart::count()}}) Productos</div>
                    <div class="card-body">
                      
                        <p>Subtotal:{{ Cart::subtotal()}}</p>
                        <p> IVA(21%): {{ Cart::tax() }}</p>
                        <p><b>TOTAL: {{ Cart::total() }}<b></p>
                      
                    </div>
                  </div>
                  @if(Cart::instance('default')->count()>0)


                    @if(Auth::guest()) 
                    <form action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <button class="btn btn-primary btn-lg">Iniciar sesion</button>
                        <form>

                        @else
                   
                    <form action="{{ route('mostrarFacturacion') }}">
                        {{ csrf_field() }}
                         <button class="btn btn-primary btn-lg">Realizar pedido</button>
                    <form>
                        @endif
                  @endif
            </div>
            

                        
            
        </div>
        
            
       


@endsection