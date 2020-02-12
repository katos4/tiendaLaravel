
<!--FIN NAVEGACION BUSCADOR -->
<!--NAVEGACION MENU -->
<header>
    <div class="row">
        
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light justify-content-end fixed-top" style="background-color: #ccff99;">
                <img src="http://localhost/tiendaLaravel/public/imagenes/logoVerde.png" width="120px" heigth="50px"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Inic5io</a>
                            
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menús</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                @foreach($tablaCategorias as $dato)

                                    <a class="dropdown-item" href="{{url('/productosMostrados/'.$dato->id_categoria)}}">{{ $dato -> nombre}}</a>

                                @endforeach
                            </div>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/prueba') }}">Productos</a>
                        </li>
                       
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/carrito') }}"><i class="fas fa-shopping-cart"></i>
                                <span class="cart-count text-success font-weight-bold">
                                    @if(Cart::instance('default')->count()>0)
                                        <span>{{Cart::instance('default')->count()}}</span>
                                    @endif
                                </span>Carrito
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acceso usuario</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('/login')}}">Iniciar sesión</a>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><img src="http://localhost/tiendaLaravel/public/imagenes/lupa.png" width="20px" heigth="20px"/></button>
                    </form>
            </nav>
        </div>
    </div>

</header>