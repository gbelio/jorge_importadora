@if(Auth::user() != null)
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav cascadaUno">
            {{--  SEARCH --}}
                <li class="nav-item" >
                    <form action="/productos/busqueda" class="form" method="GET" style="display:flex; flex-direction:row">
                        <input class="searching_box" placeholder='Buscar' type="text" name="clave" class="input-group-text mb-3 mt-3 mr-3" style="text-align: left">
                        <button type="submit" value="" class="search_button" name="" id="">
                            <img src="/img/search.svg" alt="search">
                        </button>
                    </form>
                </li>
                {{-- CAJA FILTROS Y ADMIN --}}
                <div class="box_filters_abm">
                    @isset($allCategories)
                        <div class="dropdown categorias_dropd">
                            <button class="btn btn-secondary dropdown-toggle button_categorias" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias</button>
                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                @foreach ($allCategories as $category)
                                    <li class="dropdown-submenu">
                                        <form action="/categorias/busqueda" class="form" method="GET">
                                            <input type="submit" value="{{$category->name}}" class="dropdown-item" name="clave" id="">
                                        </form>
                                        <ul class="dropdown-menu">
                                            @isset($subcategories)
                                                @foreach ($subcategories as $subcategory)
                                                    @if ($subcategory->category_id == $category->id)
                                                        <li class="dropdown-item">
                                                            <form action="/subcategorias/busqueda" class="form" method="GET">
                                                                <input type="submit" value="{{$subcategory->name}}" class="dropdown-item" name="clave" id="">
                                                            </form>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endisset
                </div>

                <div>
                    <a href="/register" class="btn btn-dark action-register">
                        REGÍSTRESE
                    </a>
                </div>

                <li class="nav-item dropdown d-flex Admin_" >
                    <a class="nav-link usuario dropdown-toggle" data-toggle="dropdown" href="/profile">{{Auth::user()->name}}</a>
                    <ul class="dropdown-menu cascadaDos">
                        @if (Auth::user()->role == 9)
                        <li class="nav-item" style="margin-top: 10px">
                            <a class="nav-link" href="/categorias/cargar">Categorías</a>
                        </li>
                        <li class="nav-item" style="margin-top: 10px">
                            <a class="nav-link" href="/subcategorias/cargar">Subcategorías</a>
                        </li>
                        <li class="nav-item" style="margin: 10px 10px 0 0">
                            <a class="nav-link" href="/productos/cargar">Productos</a>
                        </li>
                        <li class="nav-item" style="margin: 10px 10px 0 0">
                            <a class="nav-link" href="/colores/cargar">Colores</a>
                        </li>
                        <li class="nav-item" style="margin: 10px 10px 0 0">
                            <a class="nav-link" href="/slider/cargar">Imagenes De Slider</a>
                        </li>
                        <li class="nav-item" style="margin: 10px 10px 0 0">
                            <a class="nav-link" href="/compras/usuarios">Compras de Usuarios</a>
                        </li>
                        <li class="nav-item" style="margin: 10px 10px 0 0">
                            <a class="nav-link" href="/usuarios/cargar">Listado de Usuarios</a>
                        </li>
                        @else
                        <li class="nav-item" style="margin: 10px 10px 0 0">
                            <a class="nav-link2" href="/compras">Mis Compras</a>
                        </li>
                        <br>
                        @endif
                        <li class="borderli">
                            <a href="/perfil">Perfil</a>
                        </li>
                        <li class="nav-item" style="margin: 10px 10px 0 0">
                            <a href="/logout">Cerrar Sesión</a>
                        </li>
                    </ul>
                </li>
                @if (Auth::user()->role !== 9)
                <a href="/cart" class="carrito-icono" style="text-decoration: none; color: red">
                    <img src="/img/icono_carrito.svg">
                    <span style="position: relative; bottom: 10px; font-size: 14px; color: red; font-weight: bold;">{{isset($userOrderDetails) ? $userOrderDetails->count() : ''}}</span>
               </a>
                <a href="#footer" class="btn btn-dark contact-us" onclick="closeNavBar()">
                    ¡CONTACTANOS!
                </a>
                @endif
            </ul>
        {{--            <li class="nav-item dropdown d-flex Admin_" >
                <a class="nav-link usuario dropdown-toggle" data-toggle="dropdown" href="/profile">{{Auth::user()->name}}</a>
                <ul class="dropdown-menu cascadaDos">
                    @if (Auth::user()->role == 9)
                    <li class="nav-item" style="margin-top: 10px">
                        <a class="nav-link" href="/categorias/cargar">Categorías</a>
                    </li>
                    <li class="nav-item" style="margin-top: 10px">
                        <a class="nav-link" href="/subcategorias/cargar">Subcategorías</a>
                    </li>
                    <li class="nav-item" style="margin: 10px 10px 0 0">
                        <a class="nav-link" href="/productos/cargar">Productos</a>
                    </li>
                    <li class="nav-item" style="margin: 10px 10px 0 0">
                        <a class="nav-link" href="/colores/cargar">Colores</a>
                    </li>
                    <li class="nav-item" style="margin: 10px 10px 0 0">
                        <a class="nav-link" href="/slider/cargar">Imagenes De Slider</a>
                    </li>
                    <li class="nav-item" style="margin: 10px 10px 0 0">
                        <a class="nav-link" href="/compras/usuarios">Compras de Usuarios</a>
                    </li>
                    @else
                    <li class="nav-item" style="margin: 10px 10px 0 0">
                        <a class="nav-link2" href="/compras">Mis Compras</a>
                    </li>
                    <br>
                    @endif
                    <li class="borderli">
                        <a href="/perfil">Perfil</a>
                    </li>
                    <li class="nav-item" style="margin: 10px 10px 0 0">
                        <a href="/logout">Cerrar Sesión</a>
                    </li>
                </ul>
            </li>
            @if (Auth::user()->role !== 9)
            <a href="/cart" class="carrito-icono" style="height: 100%;">
                <img src="/img/icono_carrito.svg" style="filter:invert(1);">
           </a>
            <a href="#footer" class="btn btn-dark contact-us" onclick="closeNavBar()">
                ¡CONTACTANOS!
            </a>
            @endif --}}
        </div>
    </nav>
@else
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav cascadaUno">
                {{--  SEARCH --}}
                <li class="nav-item searchNoUser" >
                    <form action="/productos/busqueda" class="form" method="GET" style="display:flex; flex-direction:row">
                        <input class="searching_box" placeholder='Buscar' type="text" name="clave" class="input-group-text mb-3 mt-3 mr-3" style="text-align: left">
                        <button type="submit" value="" class="search_button" name="" id="">
                            <img src="/img/search.svg" alt="search">
                        </button>
                    </form>
                </li>
                {{-- CAJA FILTROS Y ADMIN --}}
                <div class="box_filters_abm">
                    @isset($allCategories)
                        <div class="dropdown categorias_dropd">
                            <button class="btn btn-secondary dropdown-toggle button_categorias" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorias
                            </button>
                            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                @foreach ($allCategories as $category)
                                    <li class="dropdown-submenu">
                                        <form action="/categorias/busqueda" class="form" method="GET">
                                            <input type="submit" value="{{$category->name}}" class="dropdown-item" name="clave" id="">
                                        </form>
                                        <ul class="dropdown-menu">
                                            @isset($subcategories)
                                                @foreach ($subcategories as $subcategory)
                                                    @if ($subcategory->category_id == $category->id)
                                                        <li class="dropdown-item">
                                                            <form action="/subcategorias/busqueda" class="form" method="GET">
                                                                <input type="submit" value="{{$subcategory->name}}" class="dropdown-item" name="clave" id="">
                                                            </form>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endisset
                </div>
            </ul>
            <div class="nav-actions">
                <a href="/login" class="btn btn-dark action-login">
                    LOGIN
                </a>
            </div>
            <a href="#footer" class="btn btn-dark contact-us" onclick="closeNavBar()">
                ¡CONTACTANOS!
            </a>
        </div>
    </nav>
@endif
