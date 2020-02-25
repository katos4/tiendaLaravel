
<!--FIN NAVEGACION BUSCADOR -->
<!--NAVEGACION MENU -->
<header>
    <div class="row">
        
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light justify-content-end fixed-top" style="background-color: #ccff99;">
                <img src="http://localhost/tiendaLaravel/public/imagenes/logoVerde.png" width="120px" heigth="50px"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                            
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menús</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                @foreach($tablaCategorias as $dato)

                                    <a class="dropdown-item" href="{{url('/productosMostrados/'.$dato->id_categoria)}}">{{ $dato -> nombre}}</a>

                                @endforeach
                            </div>
                            
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
                  

                        <li class="nav-item">
                            @guest
                            <a class="nav-link" href="{{url('/home')}}"><i class="fas fa-user"></i>Iniciar sesión</a>
                            @else

                            <div class="btn-group">
                                    <a class="nav-link  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hola, <strong>{{Auth()->user()->name}}</strong></a>
                                    
                                    <div class="dropdown-menu dropdown-menu-right">

                                    <a class="nav-link" href="{{ route('verPerfil') }}" ><i class="fas fa-address-card"></i>Mi perfil</a>


                                        <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    
                                        <i class="fas fa-user-slash"></i>Cerrar sesion</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                    </div>

                              </div>
                              @endguest
                        </li>
                    </ul>
                   
            </nav>
        </div>
    </div>

</header>