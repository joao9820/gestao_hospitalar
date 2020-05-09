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

	body{
		background: url({{asset('imagem/background-img.jpg')}});
		background-size: 100% 100%;

	}

	.btn {
		width: 50%;
	}

</style>
@endsection

@section('conteudo')
	
<div class='container fill'>
	<div class="row fill justify-content-center align-items-center">
		<div class="col-md-4">
			<div class="card border">

				<div class="m-2 p-2 text-center text-info bg-light">
					<h2 class="card-title">Farmácia de alto custo</h2>
				</div>
			<div class="card-body m-2 bg-light">
				
				<form method="POST" id="formLogin"> <!-- enctype para subir arquivos é necessário -->
					<div class="form-group">
					
					{{csrf_field()}}

				<div class="form-group">	
					<input class="form-control" id="email" placeholder="E-mail" type="text" name="email">
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Senha" id="password" type="password" name="senha">
				</div>
				<div class="d-md-flex flex-row-md">	
					<button class="btn btn-success mr-2" type="submit">Entrar</button>
					<button class="btn btn-primary" type="button">Cadastrar</button>
				</div>
				</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection


@section('javascript')
<script type="text/javascript">

	$('#formLogin').submit(function(event){ //event é apenas a variavel, poderia ser outro nome

			event.preventDefault(); //Não da refresh na página após submit
			
			realizarLogin();
			
			//$('#dlgProdutos').modal('hide');

	});

	function realizarLogin(){

			login = { //objeto de produtos
				email: $('#email').val(),
				password:  $('#password').val(),
			};

			console.log(login);

			$.post("/api/auth/login", login, function(data){

				console.log(data); //dado de texto JSON

				//login = JSON.parse(data.response); //Conversão para obj

				//console.log("erro: " + login); //Buscar ao adicionar o nome da categoria, ta trazendo apenas o id

				//linha = montarLinha(produto);

				//$('#tableProdutos>tbody').append(linha); //Atualiza a tabela

			}, "json")
			.done(function(response){
				console.log(response.token);
				alert("success");
			})
			.fail(function(response, status){

				console.log("erro: " + response.error + status);

				alert("fail");
			});
		}


</script>
@endsection

