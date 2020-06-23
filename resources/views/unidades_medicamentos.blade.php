@extends('layout.site', ['current' => 'unidades_medicamentos'])

@section('titulo', 'Unidades / Medicamentos')

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

			margin: 8px 2px;
			min-height: 165px;

		}

	</style>
@endsection


@section('conteudo')
<div class="d-flex justify-content-between align-items-center">
	<h1 id="title" class="mb-0">Unidades / Medicamentos</h1>
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

	<div class="row">
		<div class="col-10">
			<div class="form-group">
				<input type="text" class="form-control" name="search" placeholder="Digite o nome do medicamento" />
			</div>
		</div>
		<div class="d-block">
			<button class="btn btn-secondary mx-0"><i class="fas fa-search"></i> Buscar</button>
		</div>
	</div>

    @if(!$unidadesMed)

    	<p>Nenhum medicamento foi encontrado</p>

    @else
    <div class="d-flex flex-column justify-content-between">
	    <content>
		    <div class="row">
		    	@foreach($unidadesMed as $med)
		    	<div class="col-4">
					@component('components.card');
						@slot('class', "d-flex align-items-center")
						@slot('title')

							<h5>{{$med->medicamento->nome}}</h5>

						@endslot

						@slot('text')

							<div class="d-flex justify-content-between">
								<span>QTD: {{$med->medicamento->quantidade}}</span>
								<span><i class="fas fa-plus-circle text-success"></i></span>
							</div>

							<b>{{$med->unidade->name}}</b>

						@endslot

			    	@endcomponent
		    	</div>
		    	@endforeach
			</div>
		</content>
		<footer>
			<div class="d-flex justify-content-center my-3">
				@if(isset($_GET['unidade']))
	    			{{$unidadesMed->appends(['unidade' => $_GET['unidade']])->links()}}
    			@else
    				{{$unidadesMed->links()}}
				@endif
	    	</div>
    	</footer>
	</div>
    @endif
@endsection

@section('script')

	<script type="text/javascript">
		
		$.ajaxSetup({

			headers:{

				"X-CSRF-TOKEN" : "{{csrf_token()}}"
			}

		});

	</script>

@endsection