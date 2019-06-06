

<div class="form-group cargo-nome">	
	 <label for="cliente">Cliente  </label><br><small>IREI PEGAR POR SESSÃO, mas para simular deixei aqui</small>
	 <input type="text" id="cliente" class="form-control" name="cliente" placeholder="">
</div>


<div class="form-group cargo-valor">	
	 <label for="funcionario">Funcionário: </label>
	 <input type="text" id="funcionario" class="form-control" name="funcionario" placeholder="Digite o valor">
</div>


<div class="form-group cargo-valor">	
	 <label for="data">Data que deseja agendar: </label>
	 <input type="date" id="data" class="form-control" name="data" placeholder="Digite o valor">
</div>

<div class="form-group cargo-valor">	
	 <label for="servico">Servicos: </label><br><small>AINDA NÂO IMPLEMENTADO, SERÁ UM ARRAY</small>
	 <input type="text" id="servico" class="form-control" name="servico" placeholder="Digite o valor">
</div>





<script type="text/javascript">
    var path = "{{ route('autocomplete-cliente') }}";
    $('#cliente').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>