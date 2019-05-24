@extends('layouts.app')


@section('content')


<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-4 mt-5">
                    <div class="card border">
                        <div class="card-header">
                           <div class="card-title">
                           Solicitação de agendamento
                            </div>
                        </div>

                        <div class="card-body">                          
                                                    
                            @csrf
                            @include('agendamento/form/frm-cadastro-agendamento')
                            
                            <button id="send-cadastro" class="btn btn-success btn-sm"> Cadastrar </button>                          
                                 
                           
                            
                            <hr>
                             <a href="{{ route('listar-agendamento') }}"><button type="cancel" class="btn btn-danger btn-sm"> Cancelar </button> </a>
                        </div>
                          
                    </div>                    
                </div>
            </div>
        </div>
    </main>
    
</body>

<script> 

$(document).ready(function($){

	/* MASKS */
	$('#cargo_valor').mask('00000000,00', {reverse: true});

	/* END MASKS */ 

	$("#send-cadastro").click(function(){
	
			var cliente = $("#cliente")
			var funcionario = $("#funcionario")
      var data = $("#data")
	

			               $.ajaxSetup({
                        headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             }
                          });
            
               $.ajax({
                  url: "{{ route('solicitarAgendamento') }}",
                  method: 'POST',
                  dataType: "json",
                  data: {

                  		cliente:   cliente.val(),
						          funcionario: 	funcionario.val(),
                      data: data.val()

                     
                      },                  
                  statusCode:{
					422: function(data){
						var error = data.responseJSON.errors;
						var msg
							$(".invalid-feedback").remove();
							$(".card-body > div").children().removeClass('is-invalid')
							$(".card-body > div").children().addClass('is-valid')
							 
               $.each( error, function( key, val ) {        
            						

            						if(key == 'nome'){
            							msg = '<div class="invalid-feedback">'+ val +' </div>'
            							nome.addClass('is-invalid')            							
            							$(".cargo-nome").append(msg)

            						} 

            						 if(key == 'valor'){
            							msg = '<div class="invalid-feedback">'+ val +' </div>'
            							valor.addClass('is-invalid')            							
            					    $(".cargo-valor").append(msg)
            						}           					
            						
          					});    						
						},
            200: function(data){
              alert('Cadastro realizado com sucesso!')            
              window.location.href = '{{route("listar-agendamento")}}';
            }					
					},                                          
                  
                })
                
	}) // final send cadastro

})// Final document ready



</script>
@endsection
