

<div class="row">

	<div class="col-md-5 form-group agendamento-cliente">

		 <label class="lead" for="cliente_cpf">CPF do cliente Cliente </label><br>
		 <input type="text" id="cliente_cpf" class="form-control" name="cliente" placeholder="Digite o CPF">

	</div>

</div>


<div class="form-group agendamento-servico">	

	 <p class="lead">Selecione um Serviço: </p>
	 
</div>

<div class="row">

	<div class="col-md-12">
		@foreach ($servicos_select as $s)			
					
				<div class="servicos-select card border-dark mt-3 mb-3 mr-3" style="max-width: 12rem; min-width: 09rem; float: left;" data-servico="{{$s->id}}">
  					<div class="card-header"><img style="width: 100%;" src="https://nordicapis.com/wp-content/uploads/Laravel-logo.png">
  					</div>
  					
  					<div class="card-body text-dark">

    				<h5 class="card-title">{{$s->nome}}</h5>
    				
  				</div>	

			</div>

		@endforeach
	
	
	</div>
</div>

<div class="row">
	
	
		 
	<div class="col-md-12 form-group agendamento-funcionario" id="div-funcionario" style="display: none;">	
 	<p class="lead">Funcionário: </p>
		

	</div>
</div>

<div class="row">

	<div class="col-md-12">
		
			<div class="form-group agendamento-data" id="div-data" style="display: none;">	
			 
			 
		</div>
		
	</div>
</div>



<button id="send-cadastro" class="mt-5 btn btn-success btn-sm" style="display: none;"> Cadastrar </button>  