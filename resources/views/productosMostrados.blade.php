@extends('master')
@section('content')

        <div class="row">

          
                @foreach ($productosH as $producto)
                    <div class="col-lg-3 mt-4 d-flex align-items-stretch">  
                       
                        <div class="card border-0 shadow" style="width: 18rem;">
                        <img class="card-img-top" src="{{asset($producto -> imagenProducto)}}" alt="Card image cap"> 
                            <div class="card-body text-center">
                            
                                <p class="card-text"><strong>{{ $producto -> nombre }}</strong></p>
                                <p class="card-text">{{ $producto -> precio }} €</p>
                                <p class="card-text font-italic"><a href="{{url('/detallesProducto/'.$producto->id_producto)}}">Detalles</a></p>
                                <form action="{{ url('/carrito') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" id="id" value="{{ $producto-> id_producto }}">
                                    <input type="hidden" value="1" placeholder="1" type="text" name="cantidad" id="cantidad">
                                    <input type="image" src="http://localhost/tiendaLaravel/public/imagenes/addToCart.png" width="30px" heigth="30px">
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
               
        </div>
        {{ $productosH->links() }}
    


@endsection