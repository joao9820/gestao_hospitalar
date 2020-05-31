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
				
				<!-- Depois incluir uma msg de sessão -->
				@if(session()->has('msg'))
					<div class="alert alert-success">
						{{session()->get('msg')}}
					</div>
				@endif

				<form method="POST" action="{{ route('login') }}" id="formLogin" novalidate> <!-- enctype para subir arquivos é necessário -->

					{{csrf_field()}}

					@if($errors->has('unknown_credentials'))

						<div class="alert alert-danger">
							{{$errors->first('unknown_credentials')}}
						</div>

					@endif

					<div class="form-group">
						<span class="throw-error"></span>
						<div class="form-group">
							<input class="form-control {{$erroEmail = $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="E-mail" type="text" name="email" value="{{old('email')}}">
					          
					          @if($erroEmail)

				          		<div class="invalid-feedback">
									{{ $errors->first('email') }} 
									<!-- trará apenas o primeiro erro do array -->
								</div>
								@endif
					        </div>
						</div>
						<div class="form-group">
							<input class="form-control {{$erroPass = $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Senha" id="password" type="password" name="password" value="{{old('password')}}">
							
					          	@if($erroPass)
					          	<div class="invalid-feedback">
									{{$errors->first('password')}} <!-- trará apenas o primeiro erro do array -->
								 </div>
								@endif
					       
						</div>
						<div class="d-md-flex flex-row-md">	
							<button class="btn btn-success mr-2" type="submit">Entrar</button>
							<a href="{{route('register')}}" class="btn btn-primary">Cadastrar</a>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>

@endsection

