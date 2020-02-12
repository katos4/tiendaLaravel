@extends('master')
@section('content')

        <div class="row mt-5">

          
                @foreach ($detalles as $detalle)
                    <div class="col-lg-7 d-flex align-items-stretch"> 
                        <img class="card-img-top" src="{{asset($detalle -> imagenProducto)}}" alt="Card image cap"> 
                    </div>
                     
                   <div class="col-lg-5">
                    <p><strong>{{ $detalle -> nombre }}</strong></p>
                    <p>{{ $detalle -> precio }} €</p>
                    <p>{{ $detalle -> descripcion }}</p>
                        
                   <form action="{{ url('/carrito') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{ $detalle-> id_producto }}">

                        <div class="row">
                            @if($detalle->stock == 0)
                                <p>No hay stock disponible</p>
                            @else
                                 <div class="col-lg-2">
                                    <p>Cantidad<input class="form-control" value="1" placeholder="1" type="number" name="cantidad" id="cantidad" min="1" max="{{$detalle->stock}}"></p><br>
                                    <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                                </div>
                            @endif
                        </div>
                    </form>


                   
                   </div> 
                              
                  
                @endforeach
            
        </div>

    


@endsection