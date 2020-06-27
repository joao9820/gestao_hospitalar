@extends('layout.site', ['current' => 'unidades'])

@section('titulo', 'Unidades')

@section('style')
	<style type="text/css">

		.throw-error{
			color: red;
			display: none;
		}

		p{

			margin: 2px;
		}

		.card {
			min-height: 400px;
		
		}

		a.link-med{
			
			text-decoration: none;
			color: black;
		}

	</style>
@endsection


@section('conteudo')
<div class="d-flex justify-content-between align-items-center">
	<h1 id="title" class="mb-0">Unidades</h1>
	<div>
		<!--
		<button class="btn btn-sm m-0 bg-blue" onclick="novoUsuario()">
			<i class="fas fa-user-plus"></i> Cadastrar Usuário
		</button> -->
	</div>
</div>
    <hr/>

    @if(session()->has('alert'))
		<div class="alert alert-info">
			{{session()->get('alert')}}
		</div>
	@endif

    @if(!$unidades)

    	<p>Nenhuma unidade foi encontrada</p>

    @else
    <div class="row">
    	@foreach($unidades as $unidade)
    	<div class="col-4">
    		<a class="link-med" href="{{route('unidades_medicamentos', ['unidade' => $unidade->id])}}">
			@component('components.card');
				@slot('class', "card-hover");
				@slot('img', "/unidades/$unidade->img");

				@slot('title')

					<h4> {{$unidade->name}} </h4>

				@endslot

				@slot('text')

					<b>{{$unidade->endereco}}</b>
					<p>{{$unidade->email}}</p>
					<p>{{$unidade->phone}}</p>
					<p><strong>Horário de Funcionamento:</strong></p> 
					<p>{{$unidade->primeiro_turno_inicio}} às {{$unidade->primeiro_turno_fim}}</p>


				@endslot

	    	@endcomponent
	    	</a>
    	</div>
    	@endforeach
	</div>
    @endif

@endsection