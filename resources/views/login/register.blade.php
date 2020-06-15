@extends('layout.site-auth')

@section('titulo', 'Gestão Hospitalar')

@section('conteudo')
	
	<div class="row fill justify-content-center align-items-center">
		<div class="col-md-4">
			<div class="card border">

				<div class="m-2 p-2 text-center text-info bg-light">
					<h2 class="card-title">Farmácia de alto custo</h2>
				</div>
			<div class="card-body m-2 bg-light">
				
				<form method="POST" id="formRegister" action="{{route('register')}}"> <!-- enctype para subir arquivos é necessário -->

					{{csrf_field()}}

					<div class="form-group">

				<div class="form-group">
					
					<input class="form-control {{$erroName = $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Nome" type="text" name="name" value="{{old('name')}}">

					@if($erroName)
						<div class="invalid-feedback" id="feedback-name">
				          	{{$errors->first('name')}}
				        </div>
			        @endif

				</div>
				<div class="form-group">
					
					<input class="form-control {{$erroEmail = $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="E-mail" type="text" name="email"  value="{{old('email')}}">
					@if($erroEmail)
						<div class="invalid-feedback" id="feedback-email">
				          	{{$errors->first('email')}}
				        </div>
			        @endif
				</div>
				<div class="form-group">
					
					<input class="form-control {{$erroTelefone = $errors->has('telefone') ? 'is-invalid' : '' }}" placeholder="Telefone" type="text" name="telefone"  value="{{old('telefone')}}" id="phone" maxlength="15">
					@if($erroTelefone)
						<div class="invalid-feedback" id="feedback-telefone">
				          	{{$errors->first('telefone')}}
				        </div>
			        @endif
				</div>
				<div class="form-group">
					<input class="form-control {{$erroPass = $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Senha" id="password" type="password" name="password" value="{{old('password')}}">
					@if($erroPass)
						<div class="invalid-feedback" id="feedback-password">
				          	{{$errors->first('password')}}
				        </div>
			        @endif
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Confimar senha" id="password_confirmation" type="password" name="password_confirmation" >
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

@section('script')
	<script type="text/javascript">
		
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

		window.onload = function(){
		    document.getElementById('phone').onkeyup = function(){
		        mascara( this, mtel );
		    }
		}


	</script>
@endsection