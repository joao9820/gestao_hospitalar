<header>
		<nav>
		    <div class="nav-wrapper deep-orange">
		      <a href="#!" class="brand-logo">Curso de Laravel</a>
		      <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		      <ul class="right hide-on-med-and-down">
		      	<li><a href="/">Home</a></li>
		      	@if(Auth::guest()) <!-- método que retorna true para usuarios não logados --->
		      		<li><a href="">Login</a></li> <!-- alias da route -->
		      	@else
		      		<li><a href="#">{{Auth::user()->name}}</a></li> <!-- atraves do auth é possivel trazer dados do usuário logado -->
		      		<li><a href="">Cursos</a></li> <!-- alias da route -->
		      		<li><a href="">Sair</a></li>
		      	@endif
		        
		      </ul>
		    </div>
	  	</nav>

	  	<ul class="sidenav" id="mobile">
		    <li><a href="/">Home</a></li>
		        <li><a href="">Cursos</a></li> <!-- alias da route -->
	  	</ul>
</header>