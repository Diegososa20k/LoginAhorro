{{-- Investigar si puedo llamar un componente vue para navbar y usar un navbar funcionar en vue.js (lo primero si se puede y lo logre con home.blade.php y PantallaInicio.vue) --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Aca es el titulo de la pestana --}}
    <title>{{ config('Control Ahorro Gasto', 'Control Ahorro Gasto') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">
                <button class="btn margen btn-menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                    <i class="mdi mdi-menu icon navbar-brand"></i>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('', 'Control de Ahorros y Gastos') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link navbar-brand" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link navbar-brand" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle navbar-brand" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>



                                    {{-- <a class="dropdown-item" href="{{ route('home')}}">
                                        Inicio
                                    </a> --}}

                                    <a class="dropdown-item" href="{{ route('editar-usuario') }}">
                                        Editar usuario
                                    </a>

                                    {{-- Agregar opcion de inicio y mandar a pantalla inicio --}}




                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menú</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ route('grafica') }}">Catalogo de productos</li>
                        <li class="list-group-item"><a href="{{ route('inversion') }}">Inversiones</li>
                    </ul>
                </div>
        </main>
    </div>
</body>
</html>

<style>

.navbar{
    background-color: #2F800D !important;
}

.navbar-brand{
    color: aliceblue !important;
}
.margen {
    margin: 10px !important;
}
.icon {
    font-size: 30px; /* Tamaño del icono */
    width: 100%; /* Ocupar todo el ancho del botón */
    height: 100%; /* Ocupar toda la altura del botón */
    display: flex;
    justify-content: auto;
    align-items: auto;
    color: black
}

/* Estilo adicional para el botón para asegurar que el icono tenga espacio alrededor */
.margen {
    padding: 0;
}

.btn-menu{
    background-color: transparent;
    border-bottom-color: transparent;
}
</style>
