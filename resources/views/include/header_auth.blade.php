<!DOCTYPE html>
<html>
	<head>
		<meta name="csrf-token" content="{{csrf_token()}}">
		<title> SGMAC - @yield('titulo') </title> <!-- Criando variaveis a partir do blade-->
	  <!--Import Google Icon Font-->
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link rel="shortcut icon" href="{{asset('imagem/logo.ico')}}" >
	  <!-- Compiled and minified CSS -->
	  <link rel="stylesheet" type="text/css" href="{{asset('css/layout_auth.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	    @hasSection('style')
		    @yield('style')
	    @endif
	  <!--Let browser know website is optimized for mobile-->
	  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>
		<main>
		<div id="fundo">
			<div class='container fill'>