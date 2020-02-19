@extends('master')
@section('content')


<div class="row mt-4">

   <div class="col-lg-12"> <span>Su pedido se ha realizado con exito!</span> </div>
   <div class="col-lg-12"> <span>Resumen de tu pedido:</span> </div>

  <div class="col-lg-12 mt-3">

  <p>Total pagado: {{ $arrayDatos['total'] }}</p>
  <p>Nombre: {{ $arrayDatos['nombre_user'] }}</p>
  <p>Direccion de facturación: {{ $arrayDatos['direccion'] }}</p>
  <p>Email: {{ $arrayDatos['email_user'] }}</p>
  

  </div> 

    <div class="col-lg-3">
        <form method="POST" action="{{route('aceptar')}}">
            {{ csrf_field() }}
            <button class="btn btn-primary " type="submit">Aceptar</button>
        </form> 
    </div>

</div>






@endsection