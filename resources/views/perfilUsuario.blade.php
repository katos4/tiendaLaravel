@extends('master')
@section('content')


<div class="row mt-4">

  <div class="col-lg-3 mt-3" >
    <div class="card border-success">
      <div class="card-header" style="background-color: #ccff99;">
        <h5>Opciones de cuenta</h5>
        
      </div>
      <div class="card-body">
          <ul class="list-group list-group-flush">
            <a href="{{ route('verPedidos') }}" class="list-group-item list-group-item-action">Ver mis pedidos</a>
            <a href="{{ route('vistaEditar') }}" class="list-group-item list-group-item-action">Editar mis datos</a>
            <a href="{{route('confirmacionBaja')}}" class="list-group-item list-group-item-action">Dar de baja</a>
            
            
          </ul>
      </div>
      
    </div>
  </div>
  
    <div class="col-lg-8 mt-3" >
      <div class="card text-center border-success">
        <div class="card-header" style="background-color: #ccff99;">
          <h2>Mi Cuenta</h2>
         
        </div>
        <div class="card-body">
            <h6>{{ Auth()->user()->name}}</h6>
            <h6>{{ Auth()->user()->email}}</h6><br><br>
          
            <h5>Pedidos:</h5>
            <h2>{{$numeroPedidos}}</h2>
          
        </div>
        
      </div>
    </div>
            
</div>

@endsection