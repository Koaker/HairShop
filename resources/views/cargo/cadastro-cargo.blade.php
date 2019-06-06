@extends('layouts.app')


@section('content')


<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-1 mt-5">

                  <h1 class="display-3"> Cadastro de cargo</h1> 
                  <hr>
                            @csrf
                            @include('cargo/form/frm-cadastro-cargo')
                            
                            <button id="send-cadastro" class="btn btn-success btn-md"> Cadastrar </button>                          
                            <a href="{{ route('home') }}"><button type="cancel" class="btn btn-danger btn-md"> Cancelar </button> </a>    
                           
                            
                <hr>
                             
                       
                                       
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
	
			var nome = $("#cargo_nome")
			var valor = $("#cargo_valor")
	

			               $.ajaxSetup({
                        headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             }
                          });
            
               $.ajax({
                  url: "{{ route('cadastrarCargo') }}",
                  method: 'POST',
                  dataType: "json",
                  data: {

                  		nome:   nome.val(),
						          valor: 	valor.val()
                     
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
              window.location.href = '{{route("listar-cargo")}}';
            }					
					},                                          
                  
                })
                
	}) // final send cadastro

})// Final document ready



</script>
@endsection
