
@include('include.header')

@if($current != 'login')
	@component('include.menu')
@endif

@yield('conteudo')
@include('include.footer')	
