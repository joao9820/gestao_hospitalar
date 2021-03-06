
	<nav id="nav-column" class="d-flex flex-column shadow-sm">
		<div id="div-fixed">
			<div class="d-flex flex-column align-items-center p-3" id="logo">

				<img src="{{asset('imagem/logo.png')}}" height="125px" width="125px" />

				<h2 class="mb-0 mt-2">SGMAC</h2>
				<small class="text-center mb-1">
					Sistema de Gerenciamento de Medicamentos de Alto Custo
				</small>

			</div>
			<div class="d-flex flex-column p-4" id="link-menu">

				<div class="p-2">
					<a href="{{route('home')}}"><i class="fas fa-home"></i> Página Principal</a>
					@if(Auth::user()->is_admin)
						<a href="{{route('usuarios')}}"><i class="fas fa-user"></i> Usuários</a>
					@endif
					<a href="{{route('unidades_medicamentos')}}"><i class="fas fa-pills"></i> Medicamentos</a>
					<a href="{{route('solicitacoes')}}"><i class="fas fa-shopping-basket"></i> Solicitacões</a>
					<a href="#"><i class="fas fa-calendar-check"></i> Agendamentos</a>
					<a href="{{route('unidades')}}"><i class="fas fa-building"></i> Unidades</a>
					<a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                       <i class="fas fa-power-off"></i> Sair
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
				</div>
			</div>
		</div>
	</nav>
