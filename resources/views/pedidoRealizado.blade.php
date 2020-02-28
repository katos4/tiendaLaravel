@extends('master')
@section('content')


<div class="row justify-content-center mt-4">

   <div class="col-md-3"> <span>¡Su pedido se ha realizado con exito!</span> </div>
   <div class="w-100"></div>
   <div class="col-md-3"> <span>Gracias por confiar en MyTotem</span> </div>
   <div class="w-100"></div>
   <div class="col-md-2">
        <form method="POST" action="{{route('aceptar')}}">
            {{ csrf_field() }}
            <button class="btn btn-primary " type="submit">Volver al inicio</button>
        </form> 
   </div>


</div>






@endsection