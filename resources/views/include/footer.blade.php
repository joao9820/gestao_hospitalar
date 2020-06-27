					</div>
				</div>
			</main>
		</div>
	</div>
			<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

			@hasSection('script')
				@yield('script')
			@endif

			<script type="text/javascript">
				window.onload = function verificarItemsCesta () {
					
						$.ajax({ //recebe um objeto com alguns parâmetros

						type: "GET",
						headers:{

							"X-CSRF-TOKEN" : "{{csrf_token()}}"
						},
						url: "/api-web/solicitacoes-itens/count",
						context: this,
						dataType: 'json',

						success: function(data){ 
							$('#number-itens').text(data);
							$('#dot-shop').addClass('d-flex justify-content-center');

						},
						error: function(error, status){

							console.log(error);

							//$('.throw-error').toggle();
		                	//$('.throw-error').fadeIn(1000).html(error.responseJSON.resp);
							
						}

					});

				}
			</script>

	</body>
</html>