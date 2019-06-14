<div class="form-group servico-nome">
	
	 <label for="servico_nome">Nome </label>
	 <input type="text" id="servico_nome" class="form-control  {{$errors->has('nome') ? 'is-invalid' : '' }}" name="servico_nome" placeholder="Digite o nome do serviço">
</div>


<div class="form-group servico-valor">
	
	 <label for="servico_valor">Valor: </label>
	 <input type="text" id="servico_valor" class="form-control  {{$errors->has('valor') ? 'is-invalid' : '' }}" name="servico_valor" placeholder="Digite o valor estipulado para o serviço">
</div>


<div class="form-group servico-duracao">
	
	 <label for="servico_duracao">Duração (em minutos): </label>
	 <input type="text" id="servico_duracao" class="form-control {{$errors->has('duracao') ? 'is-invalid' : '' }}" name="servico_duracao" placeholder="Digite o tempo estimado para a execução do serviço">
</div>

<div class="form-group">
	<label>Cargos que executam este serviço</label>
	<select id="cargo_servico" class="form-control" name="cargos[]" multiple>
		@foreach($cargos_select as $c)
		<option value="{{$c->id}}"> {{$c->nome}} </option>
		@endforeach
	 
	</select>

</div>