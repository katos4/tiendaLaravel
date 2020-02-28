@extends('layouts.app')

@section('content')


<div class="row">

    <div class="col-md-5 col-md-offset-4">


        <div class="card border-success">
            <div class="card-header">
                Devolvamos tu cuenta a la vida!
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('restaurarCuenta') }}">
                    {{ csrf_field() }}
        
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dirección email</label>
                        <input type="email" class="form-control" id="emailRestaurar" name="emailRestaurar" aria-describedby="emailHelp" placeholder="Introduce email">
                        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tus datos con nadie.</small>
                       
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" id="claveRestaurar" name="claveRestaurar" placeholder="Contraseña">
                    </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
          </div>

    </div>
</div>




@endsection