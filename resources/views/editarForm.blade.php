@extends('master')
@section('content')

<div class="row mt-3">
        <div class="col-lg-6 mt-4 offset-3">
        
            <div class="card text-center border-success">
            <div class="card-header" style="background-color: #ccff99;">
                <h4>Datos de mi cuenta</h4>
            </div>
            <div class="card-body">
        
            <form action="{{route('editarDatos')}}" method="POST">
                {{ csrf_field() }}
                @foreach($datosUsuario as $dato)
                    <label for="nombreCambiar">Usuario</label>
                    <input type="text" class="form-control" name="nombreCambiar" id="nombreCambiar" value="{{$dato->name}}">
                
                    <label for="nombreApellidosCambiar">Nombre y apellidos</label>
                    <input type="text" class="form-control" name="nombreApellidosCambiar" id="nombreApellidosCambiar" value="{{$dato->nombreApellidos}}">
        
                    <label for="direccionCambiar">Dirección</label>
                    <input type="text" class="form-control" name="direccionCambiar" id="direccionCambiar" value="{{$dato->direccion}}">
        
                    <label for="dniCambiar">DNI</label>
                    <input type="text" class="form-control" name="dniCambiar" id="dniCambiar" value="{{$dato->dni}}">
                    
                    <label for="emailCambiar">Email</label>
                    <input type="text" class="form-control" name="emailCambiar" id="emailCambiar" value="{{$dato->email}}">
                
                    <button type="submit" class="btn btn-outline-success d-none d-block">Guardar</button>
                    @endforeach
                </form>
            
            </div>
            
            </div>
        
        </div>
</div>

<div class="row">
        <div class="col-lg-6 mt-3 mb-3 offset-3">
            <div class="card text-center border-success">
                <div class="card-header" style="background-color: #ccff99;">
                    <h4>Cambiar la contraseña</h4>
                </div>
                <div class="card-body">
                
                <form action="{{route('cambioClave')}}" method="POST">
                    {{ csrf_field() }}
                    <span>Contraseña nueva</span>
                <input type="hidden" name="id" id="id" value="{{Auth()->user()->id}}"/>
                <input type="password" name="nuevaClave">
                    <button type="submit" class="btn btn-danger">Cambiar</button>
                </form>
                </div>
            </div>
    </div>
</div>
@endsection
