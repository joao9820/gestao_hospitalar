@extends('layout.site', ['current' => 'login'])

@section('titulo', 'Gestão Hospitalar')

@section('style')
	
<style type="text/css">

	body{
		  background-image: url("{{asset('imagem/background-img.jpg')}}");
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

	#fundo {
	    background: rgba(38, 45, 100, 0.50);
	   	height: 100%;
	    top: 0;
	}

</style>
@endsection

@section('conteudo')
	
	<div class="row fill justify-content-center align-items-center fundo">
		<div class="col-md-4">
			<div class="card border">

				<div class="m-2 p-2 text-center text-info bg-light">
					<h2 class="card-title">Farmácia de alto custo</h2>
				</div>
			<div class="card-body m-2 bg-light">
				
				@if(isset($_GET['register']) && $_GET['register'] == 1)
					<div class="alert alert-success">
						Usuário registrado, realize o login para entrar no sistema
					</div>
				@endif

				<form method="POST" id="formLogin"> <!-- enctype para subir arquivos é necessário -->
					<div class="form-group">

				<span class="throw-error"></span>
				<div class="form-group">
					
					<input class="form-control" id="email" placeholder="E-mail" type="text" name="email">
					<div class="invalid-feedback" id="feedback-email">
			          	
			        </div>
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Senha" id="password" type="password" name="senha">
					<div class="invalid-feedback" id="feedback-password">
			          	
			        </div>
				</div>
				<div class="d-md-flex flex-row-md">	
					<button class="btn btn-success mr-2" type="submit">Entrar</button>
					<a href="{{route('register_web')}}" class="btn btn-primary">Cadastrar</a>
				</div>
				</div>
				</form>
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
            url: "{{ route('login_teste') }}",
            data: login,
            type: 'post',
            dataType: 'json',
            headers:{

				"X-CSRF-TOKEN" : "{{csrf_token()}}"
			},
            //processData: false,
            //contentType: false,
            success: function(){
            	window.location.href = "{{ route('home') }}"
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
                	
                    $.each(data.responseJSON, function (key, value) {
                    	if(key === 'resp'){
                			$('.throw-error').toggle();
                			$('.throw-error').empty().append(data.responseJSON.resp);
                    	}else{

                    		$('#' + key).addClass('is-invalid');
                    		$('#feedback-' + key).empty().append(value);
                        	
                    	}
                        
                    });
                }
            }
        });
	}

</script>
@endsection

