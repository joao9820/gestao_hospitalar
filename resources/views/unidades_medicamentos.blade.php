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
			background-color: aliceblue;

		}

		.fas-plus-circle, .fas-minus-circle{
			font-size: large;
		}

		.add-med, .remove-med{
			cursor: pointer;
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
						@slot('class', "border border-primary d-flex align-items-center")

						@slot('classBody', 'd-flex flex-column justify-content-between')
						@slot('title')

							<h5>{{$med->medicamento->nome}}</h5>

						@endslot

						@slot('text')

							<div class="d-flex justify-content-between">

								<div>
									QTD: 
									<span id="qtd-med-{{$med->medicamento->id . $med->unidade_id}}" >{{$med->quantidade}}</span><br/>
								
									<b>{{$med->unidade->name}}</b>
								
								</div>
								<div>
									<button onclick="addItemSolicitacao('{{$med->unidade_id}}', '{{$med->medicamento->id}}')" class="btn btn-primary" data-toogle="tooltip" title="Adicionar à cesta">
										<i class="fas fa-shopping-basket"></i>
									</button>
									<!--
									<i onclick="removeMedicamento('{{$med->medicamento->id . $med->unidade_id}}')" class="fas fa-minus-circle text-danger remove-med mr-1"></i>
									<span id="qtd-item-{{$med->medicamento->id . $med->unidade_id}}">0</span>
									<i onclick="addMedicamento('{{$med->medicamento->id . $med->unidade_id}}')" class="fas fa-plus-circle text-success add-med ml-1"></i>
									-->
								</div>
							</div>

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

		function addMedicamento(id){

			let qtdMed = document.getElementById("qtd-med-" + id);

			let qtdItem = document.getElementById("qtd-item-" + id);

			let qtd = parseInt(qtdItem.textContent) + 1;

			console.log(parseInt(qtdMed.textContent));			

			if(qtd <= parseInt(qtdMed.textContent))
				qtdItem.textContent = qtd;

		}

		function removeMedicamento(id){

			let qtdItem = document.getElementById("qtd-item-" + id);

			let qtd = parseInt(qtdItem.textContent) - 1;

			if(qtd >= 0)			
				qtdItem.textContent = qtd;

		}

		function addItemSolicitacao(unidadeId, medicamentoId){


			let solicitacao = {
				unidade: unidadeId,
				medicamento: medicamentoId
			}

			$.ajax({ //recebe um objeto com alguns parâmetros

				type: "POST",
				url: "/api-web/solicitacoes",
				context: this,
				dataType: 'json',
				data: solicitacao, //objeto passado

				success: function(data){ 

					console.log(data);

				},
				error: function(error, status){

					console.log(error);

					//$('.throw-error').toggle();
                	//$('.throw-error').fadeIn(1000).html(error.responseJSON.resp);
					
				}

			});

		}

	</script>

@endsection