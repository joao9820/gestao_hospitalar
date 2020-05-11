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

	#fundo {
	    background: rgba(38, 45, 100, 0.50);
	   	height: 100%;
	    top: 0;
	}

</style>
@endsection

@section('conteudo')
	
	<div class="row fill justify-content-center align-items-center">
		<div class="col-md-4">
			<div class="card border">

				<div class="m-2 p-2 text-center text-info bg-light">
					<h2 class="card-title">Farmácia de alto custo</h2>
				</div>
			<div class="card-body m-2 bg-light">
				
				<form method="POST" id="formRegister"> <!-- enctype para subir arquivos é necessário -->
					<div class="form-group">

				<span class="throw-error"></span>

				<div class="form-group">
					
					<input class="form-control" id="name" placeholder="Nome" type="text" name="name">
					<div class="invalid-feedback" id="feedback-name">
			          	
			        </div>
				</div>
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
				<div class="form-group">
					<input class="form-control" placeholder="Confimar senha" id="password_confirmation" type="password" name="password_confirmation">
					<div class="invalid-feedback" id="feedback-password_confirmation">
			          	
			        </div>
				</div>

				<div class="d-md-flex flex-row-md">	
					<button class="btn btn-primary btn-block" type="submit">Registrar</button>
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

	$('#formRegister').submit(function(event){ //event é apenas a variavel, poderia ser outro nome

			event.preventDefault(); //Não da refresh na página após submit
			
			registrar();
			
			//$('#dlgProdutos').modal('hide');

	});

	function registrar(){

		console.log('teste');

		registro = { //objeto de produtos
			name: $('#name').val(),
			email: $('#email').val(),
			password:  $('#password').val(),
			password_confirmation: $('#password_confirmation').val()
		};

		if($('input').hasClass('is-invalid')){
		    $('input').removeClass('is-invalid');
		}

		if($('.throw-error').is(':visible')){
			$('.throw-error').toggle();	
		}

		 $.ajax({
            url: "{{ route('register_teste') }}",
            data: registro,
            type: 'post',
            dataType: 'json',
            headers:{

				"X-CSRF-TOKEN" : "{{csrf_token()}}"
			},
            //processData: false,
            //contentType: false,
            success: function(){
            	window.location.href = "{{ route('login_teste') }}?register=1"
            },
            error: function(data)
            {
                if(!data.responseJSON){
                    console.log(data.responseText);
                   
                    //$('#err').html(data.responseText);
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

