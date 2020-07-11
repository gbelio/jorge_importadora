@if(Auth::user() != null)
<nav class="navbar navbar-expand-lg navbar-light bg-light">     
    <a class="navbar-brand" href="/"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @isset($allCategories)
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorias
            </button>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                @foreach ($allCategories as $category)
                    <li class="dropdown-submenu">
                        <form action="/categorias/busqueda" class="form" method="GET">
                            <input type="submit" value="<?=$category->name?>" class="dropdown-item" name="clave" id="">
                        </form>
                        <ul class="dropdown-menu">
                            @isset($subcategories)
                                @foreach ($subcategories as $subcategory)
                                    @if ($subcategory->category_id == $category->id)
                                        <li class="dropdown-item">
                                            <form action="/subcategorias/busqueda" class="form" method="GET">
                                                <input type="submit" value="<?=$subcategory->name?>" class="dropdown-item" name="clave" id="">
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
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav cascadaUno" style="justify-content:flex-end; align-items:center">      
            <li class="nav-item dropdown d-flex" >
                <a class="nav-link usuario dropdown-toggle" data-toggle="dropdown" href="/profile">{{Auth::user()->name}}</a>
                <ul class="dropdown-menu cascadaDos">
                    <li class="nav-item" style="margin-top: 10px">
                        <a class="nav-link" href="/categorias/cargar">Agregar Categoría</a>
                    </li>
                    <li class="nav-item" style="margin-top: 10px">
                        <a class="nav-link" href="/subcategorias/cargar">Agregar Subcategorias</a>
                    </li>
                    <li class="nav-item" style="margin: 10px 10px 0 0">
                        <a class="nav-link" href="/productos/cargar">Agregar Producto</a>
                    </li>
                    <li class="nav-item" style="margin: 10px 10px 0 0">
                        <a class="nav-link" href="/slider/cargar">Agregar Imagen Slider</a>
                    </li>
                    <li class="borderli">
                        <a href="/profile">Perfil</a>
                    </li>
                    <li>
                        <a href="/logout">Cerrar Sesión</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" >
                <form action="/productos/busqueda" class="form" method="GET" style="display:flex; flex-direction:row">
                    <input placeholder='Buscar' type="text" name="clave" class="input-group-text mb-3 mt-3 mr-3" style="text-align: left">
                    <input type="submit" class="btn btn-info" name="" id="" style="background-color:yellow; color:black; font-weight:bold; border: 1px solid yellow; margin:5%auto;">
                </form>
            </li>
        </ul>
    </div>
</nav>
@else
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @isset($allCategories)
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorias
            </button>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                @foreach ($allCategories as $category)
                    <li class="dropdown-submenu">
                        <form action="/categorias/busqueda" class="form" method="GET">
                            <input type="submit" value="<?=$category->name?>" class="dropdown-item" name="clave" id="">
                        </form>
                        <ul class="dropdown-menu">
                            @isset($subcategories)
                                @foreach ($subcategories as $subcategory)
                                    @if ($subcategory->category_id == $category->id)
                                        <li class="dropdown-item">
                                            <form action="/subcategorias/busqueda" class="form" method="GET">
                                                <input type="submit" value="<?=$subcategory->name?>" class="dropdown-item" name="clave" id="">
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
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <form action="/productos/busqueda" class="form" method="GET" style="display:flex; flex-direction:row">
                <input placeholder='Buscar' type="text" name="clave" class="input-group-text mb-3 mt-3 mr-3" style="text-align: left">
                <input type="submit" class="btn" value="Buscar" name="" id="" style="background-color:yellow; color:black; font-weight:bold; border: 1px solid yellow; margin:5%auto;">
            </form>
        </ul>
    </div>
</nav>
@endif