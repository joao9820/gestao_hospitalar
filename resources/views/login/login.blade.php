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
		<div class="col-md-4">
			<div class="card border">

				<div class="m-2 p-2 text-center text-info bg-light">
					<h2 class="card-title">Farmácia de alto custo</h2>
				</div>
			<div class="card-body m-2 bg-light">
				
				<form method="POST" id="formLogin"> <!-- enctype para subir arquivos é necessário -->
					<div class="form-group">
					
					{{csrf_field()}}

				<span class="throw-error"></span>
				<div class="form-group">
					
					<input class="form-control" id="email" placeholder="E-mail" type="text" name="email">
					<div class="invalid-feedback" id="feedback-email">
			          	Please choose a email.
			        </div>
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Senha" id="password" type="password" name="senha">
					<div class="invalid-feedback" id="feedback-password">
			          	Please choose a pass.
			        </div>
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

	/*function realizarLogin(){

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
			.fail(function(response){

				console.log("erro: " + response.resp);

				alert("fail");
			});
		}*/

	function realizarLogin(){

		login = { //objeto de produtos
			email: $('#email').val(),
			password:  $('#password').val(),
		};

		if($('input').hasClass('is-invalid')){
		    $('input').removeClass('is-invalid');
		}

		if($('.throw-error').is(':visible')){
			$('.throw-error').toggle();	
		}

		 $.ajax({
            url: "{{ url('/api/auth/login') }}",
            data: login,
            type: 'post',
            dataType: 'json',
            //processData: false,
            //contentType: false,

            success: function(data){
                console.log(data.token);
				alert("success");
            },
            error: function(data)
            {
                if(!data.responseJSON){
                    console.log(data.responseText);
                   
                    //$('#err').html(data.responseText);
                }else if(typeof fail_credentials != 'undefined'){

                	 alert("E-mail e/ou senha incorreto");
                }
                else{
                	 console.log(data.responseJSON);
                	  //relevant error
                	 //alert("fail");
                	
                    //$('#err').html('');
                    //key = name, value = msg
                    $.each(data.responseJSON, function (key, value) {
                    	if(key === 'resp'){
                			$('.throw-error').toggle();
                        	$('.throw-error').fadeIn(1000).html(data.responseJSON.resp); //Throw 
                    	}else{

                    		$('#' + key).addClass('is-invalid');
                        	$('#feedback' + key ).toggle();
                    	}
                        //console.log(key);
                    });
                }
            }
        });
	}

</script>
@endsection

