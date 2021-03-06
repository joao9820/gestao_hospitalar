@extends('layout.site', ['current' => 'home'])

@section('titulo', 'Página Principal')

@section('style')
<style>

    .explanation{

        background-color: #f8fafc;
        font-family: Raleway;
        font-size: initial;
        margin-bottom: 10px;
    }

    #about {

        font-family: Raleway;
        font-size: initial;
         color: #4f7ea7;
    }

    .dot {
      height: 100px;
      width: 100px;
      background-color: #edf1f5;
      border-radius: 50%;
    }

    #search-icon{
        right: 15px;
        bottom: 25px;
        position: absolute;
        color: #4f7ea7;
        font-size: 2.1em !important;
    }

    p.description {
        margin: 0px;
    }

    .card-img-top{
        padding: 4px;
    }

    a.link-med{
        
        text-decoration: none;
        color: black;
    }

</style>
@endsection

@section('conteudo')
<div class="d-flex flex-column justify-content-between fill">
	<content  id="section">

	<h1 id="title" class="m-1">Seja Bem Vindo!</h1>

    <div id="about" class="p-4 text-center">

        <div class="ml-2">
            <p>Esse Sistema foi idealizado e desenvolvido com o intuito de facilitar o acesso aos medicamentos disponibilizados por aqueles que utilizam o serviço da Farmácia de Alto Custo do DF.</p>
        </div>
    </div>


    <div class="d-flex justify-content-center mb-4">
       
        <div class="col-md-5">
             <a class="link-med" href="{{route('unidades_medicamentos')}}">
            @component("components.card")
                @slot('class', "card-hover");
                @slot('title')
                    <h4>Medicamentos</h4>
                @endslot
                    @slot('text')
                    <div class="d-flex justify-content-between align-items-center">
                        <p id="cardDesc">
                            Veja a listagem de medicamentos
                        </p>
                        <div>
                          <i class="fas fa-arrow-right text-primary"></i>
                        </div>
                    </div>
                    @endslot
            @endcomponent
            </a>
        </div>
 
        <div class="col-md-5">
            <a class="link-med" href="{{route('unidades')}}">
                @component("components.card")
                    @slot('class', "card-hover");
                    @slot('title')
                        <h4>Unidades</h4>
                    @endslot
                        @slot('text')
                        <div class="d-flex justify-content-between align-items-center">
                            <p id="cardDesc">
                                Selecione uma unidade para ver os medicamentos
                            </p>
                            <div>
                        
                                    <i class="fas fa-arrow-right text-primary"></i>
                               
                            </div>
                        </div>
                        @endslot
                    
                @endcomponent
            </a>
        </div>
    </div>


    <div id="how-works" class="p-4 explanation mb-4">
        <div class="content">
            <div class="d-flex">
                <h3 class="d-inline-block mr-1"><i class="fas fa-question-circle"></i> </h3>
                <div>
                <h3 class="d-inline-block">Como funciona</h3>
                    <div class="ml-2">
                        <p>A solicitação do medicamento pode ser feita basicamente em 3 passos</p>
                    </div>
                </div>
            </div>
            <div class="row" id="step-to-step">
                <div class="col d-flex justify-content-center">
                    <div class="col-4">
                        <div class="dot d-flex flex-row justify-content-center align-items-center" style="position: relative">
                            <i class="fas fa-search z-index" id="search-icon"></i>
                            <i class="fas fa-prescription-bottle text-info fa-4x"></i>
                        </div>
                    </div>
                    <div class="col-8 align-self-center">
                        <p class="text-muted description">Clique em solicitação e busque o seu medicamento na barra de pesquisa</p>
                    </div>
                    
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="col-4">
                        <div class="dot d-flex flex-row justify-content-center align-items-center">
                            <i class="fas fa-hospital-user fa-3x text-info"></i>
                        </div>
                    </div>
                    <div class="col-8 align-self-center">
                        <p class="text-muted description">Selecione uma unidade que o possua em seu estoque</p>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="col-4">
                        <div class="dot d-flex flex-row justify-content-center align-items-center">
                            <i class="fas fa-calendar-check fa-3x text-info"></i>
                        </div>
                    </div>
                    <div class="col-8 align-self-center">
                        <p class="text-muted description">Informe a quantidade necessária e agende a sua retirada</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
	</content>
    @if(Auth::user()->is_admin)
    <section class="d-flex flex-column-reverse">
    	<div class="row">
	        <div class="col-md-12">
	            <div class="card">
	                <div class="card-header">Últimas Solicitações</div>
                    <div class="card-body">
                       
                        @if(!isset($solicitacoes))

                            Não há solicitações para listar ainda

                        @endif
                    </div>
	            </div>
	        </div>
    	</div>
	</section>
    @endif
</div>

@endsection
