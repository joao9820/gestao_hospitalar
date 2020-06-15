@extends('layout.site', ['current' => 'home'])

@section('titulo', 'Usuários')

@section('style')
	<style type="text/css">

		.throw-error{
			color: red;
			display: none;
		}

	</style>
@endsection


@section('conteudo')
<div class="d-flex justify-content-between align-items-center">
	<h1 id="title" class="mb-0">Usuários</h1>
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

    @if(!$users)

    	<p>Nenhum usuário foi encontrado</p>

    @else
		@component('components.table');
			
		@slot('tableId', "tableUser")

			@slot('thead')
				<th>ID</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Telefone</th>
				<th>Nível de Acesso</th>
				<th>Data de Criação</th>
				<th>Ações</th>
			@endslot

			@slot('tbody')
		    	@foreach($users as $user)
			    	<tr>
			    		<td style="font-weight: bolder;">{{$user->id}}</td>
			    		<td id="teste">{{$user->name}}</td>
			    		<td>{{$user->email}}</td>
			    		<td>{{$user->phone ?: '--'}}</td>
			    		<td>{{$user->nivelAcesso}}</td>
			    		<td>{{$user->dataCriacao}}</td>
			    		<td>

			    			<button class="btn btn-warning btn-sm" 
			    			onclick="editarUsuario('{{$user->id}}')">
			    				<i class="fas fa-edit"></i>
			    			</button>

			    			<button class="btn btn-danger btn-sm" 
			    			onclick="confirmDelete('{{$user->id}}')">
			    				<i class="fas fa-trash"></i>
			    			</button>

			    		</td>
		    		</tr>
		    	@endforeach
	    	@endslot
	    @endcomponent
    @endif

    <div class="modal" tabindex="1" role="dialog" id="modalUsuario">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<span class="throw-error"></span>
			<form class="form-horizontal" id="formUsuario">
				<div class="modal-header">
					<h5 class="modal-title">Editar Usuário</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id" class="form-control">
					<div class="form-group">								 
							<!-- for é um id referenciável na view -->
							<label for="name" class="control-label">Nome</label>
							<input type="text" class="form-control" 
							id="name" placeholder="Nome">
							<div id="feedback-name" class="invalid-feedback">

							</div>
					</div>
							
					<div class="form-group">
					<label for="email" class="control-label">E-mail</label>	
						<input type="email" class="form-control" 
						id="email" placeholder="E-mail">
						<div id="feedback-email" class="invalid-feedback">
								
						</div>
					</div>

					<div class="form-group">
						<label for="phone" class="control-label">Telefone</label>
						<input type="text" class="form-control" 
						id="phone" placeholder="Telefone" maxlength="15">
						<div id="feedback-phone" class="invalid-feedback">
								
						</div>
					</div>
<!--
					<div class="form-group">
						<label for="password" class="control-label">Senha</label>
						<input type="password" class="form-control" 
						id="password" placeholder="Senha">
						<div id="feedback-password" class="invalid-feedback">
								
						</div>
					</div>

					<div class="form-group">
						<label for="password-confirmation" class="control-label">Confirme a Senha</label>
						<input type="password" class="form-control" 
						id="password-confirmation" placeholder="Confirme a Senha">
					</div>
-->
					<label>Nível de Acesso</label><br/>

					<div class="form-check form-check-inline">
						<input id="acessoAdmin" name="acesso" type="radio" value="1" class="form-check-input"> 
						<label class="form-check-label" for="acessoAdmin">Administrador</label>
					</div>
					<div class="form-check form-check-inline">
						<input id="acessoUsuario" name="acesso" type="radio" value="0" class="form-check-input">
						<label class="form-check-label" for="acessoUsuario">Usuário</label>
					</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
					<button type="reset" class=" btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button> 	
				</div>
			</form>
		</div>
	</div>
</div>



@endsection


@section('script')
	<script type="text/javascript">

		$.ajaxSetup({

			headers:{

				"X-CSRF-TOKEN" : "{{csrf_token()}}"
			}

		});


		var user = "";
		
		function confirmDelete(id){

			confirmAction = confirm('Deseja apagar o usuário com ID de nº ' + id + '?');

			if(confirmAction){

				$.ajax({ //recebe um objeto com alguns parâmetros

				type: "DELETE",
				url: "/api-web/usuarios/" + id,
				dataType: 'json',
				context: this,
				success: function(){ //se conseguir executar o delete

					linhas = $('#tableUser>tbody>tr');

					idDel = linhas.filter( function(i, elemento){ 

						return elemento.cells[0].textContent == id;

					});

					if(idDel){

						idDel.remove();

					}
			
				},
				error: function(error){
					console.log(error);
				}

			});


			}
				

		}

		function montarLinha(u){ //recebe o objeto do produto

			var linha = "<tr>" + 

			"<td>" + u.id + "</td>" + 

			"<td>" + u.name + "</td>" + 

			"<td>" + u.email + "</td>" + 

			"<td>" + u.phone + "</td>" +

			"<td>" + u.nivelAcesso + "</td>" +  

			"<td>" + u.dataCriacao + "</td>" +

			"<td>" + 
					'<button class="btn btn-sm btn-warning" onclick="editarUsuario('+ u.id +')">i class="fas fa-edit"></i></button>' + 
					'<button class="btn btn-sm btn-danger ml-2" onclick="confirmDelete('+ u.id +', '+ u.name +')" ><i class="fas fa-trash"></i></button>' +
			"</td>" +  

			"</tr>";		

			return linha;	
		}


		function novoUsuario(){

			$('#id').val('');
			$('#name').val('');
			$('#email').val('');
			$('#phone').val('');
			$('#password').val('');
			$('#password-confirmation').val('');
			
			$('#acessoAdmin').prop('checked', false);
			//Será usuário por padrão
			$('#acessoUsuario').prop('checked', true);

			$('#modalUsuario').modal('show');		
		}

		function editarUsuario(id){


			$.getJSON("/api-web/usuarios/" + id, function(data){

				$('#id').val(data.id);
				$('#name').val(data.name);
				$('#email').val(data.email);
				$('#phone').val(data.phone);

				if(data.is_admin == true)
					$('#acessoAdmin').prop('checked', true);
				else
					$('#acessoUsuario').prop('checked', true);


				$('#modalUsuario').modal('show');	

			});	

		}

		function setarDadosInput(){

			user = {

				id: $('#id').val(),
				name: $('#name').val(),
				email: $('#email').val(),
				phone: $('#phone').val(),				
				is_admin: $('#acessoAdmin').is(':checked') ? 1 : 0

			};

		}

		function cadastrarUsuario(){

			$.ajax({ //recebe um objeto com alguns parâmetros

				type: "POST",
				url: "/api-web/usuarios",
				context: this,
				dataType: 'json',
				data: user, //objeto passado

				success: function(data){ 

				user = data.obj;

				linha = montarLinha(user);

				$('#tableProdutos>tbody').append(linha); //Atualiza a tabela


				/*var background = setInterval(function () {
					    
				    e.css("background-color", function () {
					        this.switch = !this.switch
					        return this.switch ? "#e9ecef" : ""
					    });
					}, 400);

					setTimeout(function() {
					    clearInterval(background);
					}, 1600);*/

					$('#modalUsuario').modal('hide');

				},
				error: function(error, status){

					console.log(error);

					//$('.throw-error').toggle();
                	//$('.throw-error').fadeIn(1000).html(error.responseJSON.resp);
					
				}

			});

		}

		function atualizarUsuario(){

			$.ajax({ //recebe um objeto com alguns parâmetros

				type: "PUT",
				url: "/api-web/usuarios/" + user.id,
				context: this,
				dataType: 'json',
				data: user, //objeto passado

				success: function(data){ 

					users = data.obj;

					linhas = $('#tableUser>tbody>tr');

					e = linhas.filter(function(i, elemento){ 

						return (elemento.cells[0].textContent == users.id);

					});

					if(e){
						//console.log(prod);
						//cells corresponde a coluna da tabela
						e[0].cells[0].textContent = users.id;
						e[0].cells[1].textContent = users.name;
						e[0].cells[2].textContent = users.email;
						e[0].cells[3].textContent = users.phone;
						e[0].cells[4].textContent = users.nivelAcesso;

					}


					var background = setInterval(function () {
					    
				    e.css("background-color", function () {
					        this.switch = !this.switch
					        return this.switch ? "#e9ecef" : ""
					    });
					}, 400);

					setTimeout(function() {
					    clearInterval(background);
					}, 1600);

					$('#modalUsuario').modal('hide');

				},
				error: function(error, status){
					
					if(error.status == 400){

						 $.each(error.responseJSON, function (key, value) {
	                    	
	                    	$('#' + key).addClass('is-invalid');
	                    	$('#feedback-' + key).html(value);
	                       
	                    });

					}else{

						$('.throw-error').toggle();
                    	$('.throw-error').fadeIn(1000).html(error.responseJSON.resp); //Throw 

					}
					
				}

			});


		}

		$('#formUsuario').submit(function(event){ //event é apenas a variavel, poderia ser outro nome

				event.preventDefault(); //Não da refresh na página após submit

				if($('input').hasClass('is-invalid')){
				    $('input').removeClass('is-invalid');
				}

				setarDadosInput();

				if($('#id').val() != ''){

					atualizarUsuario()
					
				}else{
					cadastrarUsuario();	
				}

		});

		function mascara(o,f){
		    v_obj=o
		    v_fun=f
		    setTimeout("execmascara()",1)
		}
		function execmascara(){
		    v_obj.value=v_fun(v_obj.value)
		}
		function mtel(v){
		    v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
		    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
		    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
		    return v;
		}
		function id(el){
		    return document.getElementById( el );
		}

		window.onload = function(){
		    id('phone').onkeyup = function(){
		        mascara( this, mtel );
		    }
		}

	

	</script>
@endsection