

<div class="row">

	<div class="col-md-5 form-group agendamento-cliente">

		 <label class="lead" for="cliente_cpf">CPF do cliente Cliente </label><br>
		 <input type="text" id="cliente_cpf" class="form-control" name="cliente" placeholder="Digite o CPF">

	</div>

</div>


<div class="form-group agendamento-servico agendamento_selecionado">	

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

<div class="row funcionario_selecionado">
	
	
		 
	<div class="col-md-12 form-group agendamento-funcionario" id="div-funcionario" style="display: none;">	
 	
		

	</div>
</div>



<div class="row agendamento_dia_selecionado">

	<div class="col-md-12" id="div-agendamento-dia" style="display: none;">
		
		<div class="form-group"> <!-- Date input -->
        	<label class="control-label" for="date">Date</label>
        	<input class="form-control" id="dia_escolhido" name="date" placeholder="MM/DD/YYYY" type="date"/>
      </div>
		
	</div>
</div>

<div class="row horario_selecionado">

	<div class="col-md-12">
		
			<div class="form-group agendamento-data" id="div-data" style="display: none; height: 10px;">	
			 
			 
		</div>
		
	</div>
</div>



<button id="send-cadastro" class="mt-5 btn btn-success btn-sm" style="display: none;"> Cadastrar </button>  

<script type="text/javascript">
	$(document).ready(function(){
	$(function(){
   		 var dtToday = new Date();
   		 
   		 var month = dtToday.getMonth() + 1;
   		 var day = dtToday.getDate();
   		 var year = dtToday.getFullYear();
   		 if(month < 10)
   		     month = '0' + month.toString();
   		 if(day < 10)
   		     day = '0' + day.toString();
   		 
   		 var maxDate = year + '-' + month + '-' + day;
   		 
   		 $('#dia_escolhido').attr('min', maxDate);
});
	})

</script>