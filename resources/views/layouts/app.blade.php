<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', 'SportOnAplication') </title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<header>

    <nav class="navbar sticky-top navbar-expand-sm navbar-light bg-white mb-4">
        <div class="container">
             <!-- Collapsed Hamburger -->
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'SportOnAplcation') }}
                </a>
    
               
    
            </div>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>
    
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right ml-3">
                    <!-- Authentication Links -->
                    @guest 
                        {{-- zona para invitados --}}
                        <li class="nav-item"><a class="nav-link float-md-rigth" href="{{ route('login') }}"> Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"> Register</a></li>
                    @else
                        @can('lista_escenario')
                            <li class="nav-item">
                                
                                <a  class="nav-link" href="{{ url('/escenarios') }}"> Escenarios</a>
                            </li>
                        @endcan
                        @can('lista_user')
                            <li class="nav-item">
                                
                                <a  class="nav-link" href="{{ url('/users') }}"> Usuarios</a>
                            </li>
                        @endcan
                        @can('lista_role')
                            <li class="nav-item">
                                
                                    <a  class="nav-link" href="{{ url('/roles') }}"> Roles</a>
                            </li>
                        @endcan
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                    id="navbarDropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} 
                                </a>
    
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                                        <a class="dropdown-item" href="{{ url('web/perfil') }}" >
                                            perfil
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    
                                </div>
                            </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<body>
    <div id="app">
        @if (session('info'))
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(count($errors))            
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/selectHora.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
