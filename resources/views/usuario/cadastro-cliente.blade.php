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
                           Cadastro
                            </div>
                        </div>

                        <div class="card-body">                          
                                                    
                            @csrf
                            @include('usuario/form/frm-cadastro-cliente')
                            
                            <button id="send-cadastro" class="btn btn-success btn-sm"> Cadastrar </button>                          
                                 
                           
                            
                            <hr>
                             <a href="{{ route('home') }}"><button type="cancel" class="btn btn-danger btn-sm"> Cancelar </button> </a>
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

	$('#usuario_telefone').mask('(00) 0000-00000');
	$('#usuario_cpf').mask('000.000.000-00', {reverse: true});

	/* END MASKS */ 

	$("#send-cadastro").click(function(){
	
			var nome = $("#usuario_nome")
			var email = $("#usuario_email")
			var cpf = $("#usuario_cpf")
			var senha = $("#usuario_senha")
			var senha2 = $("#usuario_senha2")
			var telefone = $("#usuario_telefone")

			               $.ajaxSetup({
                        headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             }
                          });
            
               $.ajax({
                  url: "{{ route('cadastrarCliente') }}",
                  method: 'POST',
                  dataType: "json",
                  data: {

                  		nome: 					      $("#usuario_nome").val(),
						          email: 					      $("#usuario_email").val(),
						          cpf: 				         	$("#usuario_cpf").val(),
						          senha: 					      $("#usuario_senha").val(),
						          senha_confirmation: 	$("#usuario_senha2").val(),
						          telefone: 				    $("#usuario_telefone").val()
                     
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
            							$(".cliente-nome").append(msg)

            						} 

            						 if(key == 'cpf'){
            							msg = '<div class="invalid-feedback">'+ val +' </div>'
            							cpf.addClass('is-invalid')            							
            							$(".cliente-cpf").append(msg)
            						}  

            						if(key == 'senha_confirmation'){
            							msg = '<div class="invalid-feedback">'+ val +' </div>'
            							senha2.addClass('is-invalid')            							
            							$(".cliente-senha2").append(msg)
            						}  

            						if(key == 'senha'){
            							msg = '<div class="invalid-feedback">'+ val +' </div>'
            							senha.addClass('is-invalid')            							
            							$(".cliente-senha").append(msg)
            						}

            						if(key == 'telefone'){
            							msg = '<div class="invalid-feedback">'+ val +' </div>'
            							telefone.addClass('is-invalid')            							
            							$(".cliente-telefone").append(msg) 
            						}

            						if(key == 'email'){
            							msg = '<div class="invalid-feedback">'+ val +' </div>'
            							email.addClass('is-invalid')            							
            							$(".cliente-email").append(msg) 
            						}
            						
          					});    						
						},
            200: function(data){
              alert('Cadastro realizado com sucesso!')            
              window.location.href = '{{route("login")}}';
            }					
					},                                          
                  
                })
                
	}) // final send cadastro

})// Final document ready



</script>
@endsection
