<!DOCTYPE html>
<html>
	<head>
		<meta name="csrf-token" content="{{csrf_token()}}">
		<title> SGMAC - @yield('titulo') </title> <!-- Criando variaveis a partir do blade-->
	  <!--Import Google Icon Font-->
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

      <link rel="shortcut icon" href="{{asset('imagem/logo.ico')}}" >

      <link href="{{asset('fonts/google')}}" >

	  <!-- Compiled and minified CSS -->
	  <link rel="stylesheet" type="text/css" href="{{asset('css/layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	    
	    @hasSection('style')
		    @yield('style')
	    @endif
	  <!--Let browser know website is optimized for mobile-->
	  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

<body>
<div class="d-flex flex-row fill">
    @include('include.menu')
    <div class="d-flex flex-column w-100">
        <header class="navbar navbar-expand-md shadow-sm">
            <div class="container-fluid" >
            <span class="badge badge-light">
                <a class="navbar-brand mx-0 p-1" href="{{ url('/') }}">
                   <i class="fas fa-pills"></i> <span>SGMAC</span>
                </a>
            </span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                   Sair
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

		<main>
		      <div class="container fill py-2">
                    <div class="row mx-0 d-block fill">