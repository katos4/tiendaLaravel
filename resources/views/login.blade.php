@extends('master')
@section('content')

<div class="container">
    <div class="row mt-4"></div>
    <div class="row mt-5">
        <div class="col-lg-3 offset-lg-4" style="border: 1px solid black; border-radius:15px; padding: 30px;">
            <div class="form-login">
                <h4>Bienvenido de nuevo.</h4>
                <form method="POST" action="{{ route('login.inicioSesion') }}">
                    {{ csrf_field() }}
                    <input type="text" id="user" class="form-control input-sm chat-input" placeholder="usuario" />
                    </br>
                    <input type="text" id="pass" class="form-control input-sm chat-input" placeholder="contraseña" />
                    </br>
                    <div class="wrapper">
                        <span class="group-btn">    
                            <button type="submit" class="btn btn-primary btn-md btn-block">Entrar<i class="fa fa-sign-in"></i></button> 
                        </span>
                    </div>
                </form>
            </div>
        
        </div>
    </div>
</div>


@endsection