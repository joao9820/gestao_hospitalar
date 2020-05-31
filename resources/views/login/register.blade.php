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
				
				<form method="POST" id="formRegister" action="{{route('register')}}"> <!-- enctype para subir arquivos é necessário -->

					{{csrf_field()}}

					<div class="form-group">

				<span class="throw-error"></span>

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
