<div class="card">
	@if(isset($img))
		<img class="card-img-top" src="{{asset("imagem/$img")}}" alt="Imagem Card" height="200px"></img>
	@endif
			<div class="card-body">
			<div class="card-title">
				{{$title}}
			</div>
			
			<div class="card-text">{{$text}}</div>
	</div>	
</div>