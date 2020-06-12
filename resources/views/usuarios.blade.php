@extends('layout.site', ['current' => 'home'])

@section('titulo', 'Usuários')


@section('conteudo')
<div class="d-flex justify-content-between align-items-center">
	<h1 id="title" class="mb-0">Usuários</h1>
	<div>
		<button class="btn btn-sm m-0 bg-blue">
			<i class="fas fa-user-plus"></i> Cadastrar Usuário
		</button>
	</div>
</div>
    <hr/>

    @if(session()->has('alert'))
		<div class="alert alert-info">
			{{session()->get('alert')}}
		</div>
	@endif

    @if(!$users)

    	<p>Nenhum usuário foi encontrado</p>

    @else
		@component('components.table');
			
			@slot('thead')
				<th>ID</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Telefone</th>
				<th>Data de Criação</th>
				<th>Ações</th>
			@endslot

			@slot('tbody')
		    	@foreach($users as $user)
			    	<tr>
			    		<td style="font-weight: bolder;">{{$user->id}}</td>
			    		<td>{{$user->name}}</td>
			    		<td>{{$user->email}}</td>
			    		<td>{{$user->phone ?: '--'}}</td>
			    		<td>{{$user->dataCriacao}}</td>
			    		<td>

			    			<button class="btn btn-warning  btn-sm">
			    				<i class="fas fa-edit"></i>
			    			</button>

			    			<button class="btn btn-danger btn-sm" 
			    			onclick="confirmDelete('{{$user->id}}','{{$user->name}}')">
			    				<i class="fas fa-trash"></i>
			    			</button>

			    		</td>
		    		<tr/>
		    	@endforeach
	    	@endslot
	    @endcomponent
    @endif
@endsection

@section('script')
	<script type="text/javascript">
		
		function confirmDelete(id, usuario){

			confirmAction = confirm('Deseja apagar o usuário ' + usuario + '?');

			if(confirmAction)
				window.location.href = "{{url('usuarios/apagar')}}/" + id;

		}

	</script>
@endsection