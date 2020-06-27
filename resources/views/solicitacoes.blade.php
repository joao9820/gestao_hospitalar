@extends('layout.site', ['current' => 'solicitacoes'])

@section('titulo', 'Solicitacões')

@section('conteudo')


<h1 id="title" class="mb-3">Solicitações</h1>
    <div class="row">

    	@if($solicitacoes->isEmpty())

    		<div class="alert alert-secondary">Nenhuma solicitação em andamento</div>

    	@else

	    	@foreach($solicitacoes as $solicitacao)

		    	<div class="col-12">
					@component('components.card');
						@slot('class', "mb-3")

						@slot('classBody', '')
						@slot('title')

							<h5>{{$solicitacao->id}} . {{$solicitacao->unidades->name}}</h5>

						@endslot

						@slot('text')

							<div class="d-flex justify-content-between">

								<div>
									
									@if($solicitacao->medicamentos->isEmpty())


										Não há medicamentos nessa solicitação


									@else

										@foreach($solicitacao->medicamentos as $med)

											<h5 class="d-inline-block">{{$med->nome}}</h5>
											

										<i onclick="removeMedicamento('{{$solicitacao->unidade_id . $med->id}}')" class="fas fa-minus-circle text-danger remove-med mr-1"></i>
										<span id="qtd-item-{{$solicitacao->unidade_id . $med->id}}">{{$med->pivot->quantidade_item}}</span>
										<i onclick="addMedicamento('{{$solicitacao->unidade_id . $med->id}}')" class="fas fa-plus-circle text-success add-med ml-1"></i> <br/>
										

										@endforeach

									@endif
								
								</div>
								<div>
									<button class="btn btn-sucess">
										<i class="fas fa-arrow-right"></i> Finalizar
									</button>
									
								</div>
							</div>

						@endslot
			    	@endcomponent
		    	</div>
	    	@endforeach

    	@endif
	</div>
@endsection