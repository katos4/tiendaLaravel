@extends('master')
@section('content')

<div class="row">
    <section class="posts col-lg-12 col-md-12 col d-none d-md-block">
         <article class="post clearfix shadow p-4 mb-4"> 
    
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                
                <div class="carousel-inner">
                  <div class="carousel-item active">
                        <img class="d-block w-100" src="imagenes/slider2.png" height="300">
                  </div>
                  <div class="carousel-item">
                        <img class="d-block w-100" src="imagenes/slider1.jpg" height="300">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Siguiente</span>
                </a>
          </div><br>
    </section>
  </div>

  <div class="row justify-content-center">
      <h1 class="col-lg-12 text-center mb-3">Productos destacados </h1>
          @foreach ($productosDes as $producto)
          <div class="col-lg-3">

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset($producto -> imagenProducto)}}" alt="Card image cap">
                <div class="card-body text-center">
                    <p class="card-text"><strong>{{ $producto -> nombre }} <span class="badge badge-secondary">NUEVO!</span></strong></p>
                    <p class="card-text">{{ $producto -> precio }}</p>
                </div>
            </div>
          </div>
          @endforeach

    </div>

  @endsection