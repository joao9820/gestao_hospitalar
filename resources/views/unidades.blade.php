@extends('layout.site', ['current' => 'login'])

@section('titulo', 'Gestão Hospitalar')

@section('style')
	
<style type="text/css">
	
	html, body {
	  height: 100%;
	}

	.fill { 
	    min-height: 100%;
	    height: 100%;
	}

	.throw-error{
		color: red;
		display: none;
	}

	.invalid-feedback{
		display: none;
	}

	.btn {
		width: 50%;
	}

</style>
@endsection

@section('conteudo')

<div class='container fill'>
	<div class="row fill justify-content-center align-items-center">
		<table class="table table-bordered table-hover" id="tableUnidades">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th>Criado em</th>
					<th>Atualizado em</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>
@endsection


@section('javascript')
<script type="text/javascript">

	$.ajax({
        url: "{{ url('/api/unidades') }}",
        type: 'get',
        headers: {
	        "Authorization": localStorage.getItem('Authorization')
		},
		dataType: 'json',
		success: function(data){
			carregarProdutos(data);
		},
		error: function(data){
			//posso passar algum parâmetro para exibir mensagem de erro depois
			window.location.href = "{{ url('/login') }}"
		}

	 });

	function carregarProdutos(unidades){

		for(i=0;i<unidades.length;i++){

			linha = montarLinha(unidades[i]);

			$('#tableUnidades>tbody').append(linha); //o > significa que irá adicionar o elemento dentro da tag
		}
		
	}

	function montarLinha(p){ //recebe o objeto do produto

		var linha = "<tr>" + 

		"<td>" + p.id + "</td>" + 

		"<td>" + p.name + "</td>" + 

		"<td>" + p.created_at + "</td>" + 

		"<td>" + p.updated_at + "</td>" + 

		"<td>" + 
				'<button class="btn btn-sm btn-warning" onclick="editar('+ p.id +')">Editar</button>' + 
				'<button class="btn btn-sm btn-danger ml-2" onclick="remover('+ p.id +')" >Apagar</button>' +
		"</td>" +  

		"</tr>";		

		return linha;	
	}


</script>
@endsection

