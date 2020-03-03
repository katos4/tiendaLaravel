@extends('master')
@section('content')



<div class="row mt-4">

    <div class="col-md-5 offset-md-3 mt-4">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cancelar cuenta</h5>
             
              <p class="card-text">¿Estas seguro que quiere dar de baja su cuenta?</p>
            <form action="{{route('darDeBaja')}}" method="post">
                {{ csrf_field() }}
              <button type="submit" class="btn btn-primary" href="#" class="card-link">Aceptar</button>
                <a class="btn btn-danger" href="{{url('/')}}" class="card-link">Cancelar</a>
        </form>
        </div>
          </div>
    </div>


</div>


@endsection