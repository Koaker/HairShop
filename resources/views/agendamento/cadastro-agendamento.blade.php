@extends('layouts.app')


@section('content')


<body>
    <main>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-11 offset-md-1 mt-5">
                    
                       
                          <h1 class="display-3"> Agendamento </h1>
                          
                                               
                            <div class="mt-5 mb-5">
                              
                                                   
                            @csrf
                            @include('agendamento/form/frm-cadastro-agendamento')
                            </div> 

                            <div class="row">
                              <div class="col-md12">
                                        
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
var flag_servico = 0;
var flag_funcionario = 0


function selectHorario(id){


           elemento = $(".funcionario-select[data-funcionario="+ id +"]")

           $(".funcionario-select").removeClass('border-danger');         
           $(".funcionario-select").addClass('border-dark');
          
           elemento.removeClass('border-dark');          
           elemento.addClass('border-danger');

          if(!$("#div-data").is(":visible"))
              $("#div-data").show();
}


function selectFuncionario(id){

          
           elemento = $(".funcionario-select[data-funcionario="+ id +"]")

           $(".funcionario-select").removeClass('border-danger');         
           $(".funcionario-select").addClass('border-dark');
          
           elemento.removeClass('border-dark');          
           elemento.addClass('border-danger');

          if(!$("#div-data").is(":visible"))
              $("#div-data").show();


               $.ajaxSetup({
                       headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                         });
                
                   $.ajax({
                      url: "{{ route('getHorario') }}",
                      method: 'GET',
                      dataType: "json",
                      data: { funcionario: id } ,                  
                      statusCode:{
              422: function(data){
                  console.log(data);
                                             
                },
                200: function(data){                            
                      console.log(data)
                        $("#div-data").children().remove();
                        titulo = '<p class="lead"> Selecione o horário: </p>';
                        $("#div-data").append(titulo)
                      $.each( data.horarios, function( key, val ) {        
                        
                         msg = '<div onclick="selectHorario('+val+')" data-funcionario="'+val+'" class="funcionario-select card border-dark mt-3 mb-3 mr-3" style="max-width: 5rem; min-width: 09rem; float: left;"> <div class="card-header"><img style="width: 100%;" src="https://cdn-images-1.medium.com/max/1200/1*SL4sWHdjGR3vo0x5ta3xfw.jpeg"> </div> <div class="card-body text-dark"><h5 class="card-title">'+val+'</h5> </div></div>'   

                        $("#div-data").append(msg)

                    });

                  
                }         
              },                                          
                      
         })


}
      

$(document).ready(function($){


  /* FUNCTIONS */


  $(".servicos-select").click(function(){
     if( !$(".funcionario-select").is(":visible") ) 
        $("#div-data").children().remove();

    var valor_servico = $(this).data('servico')
    if(flag_servico != valor_servico ){
        flag_servico = valor_servico            
          
          $(".servicos-select").removeClass('border-danger');
          $(".servicos-select").addClass('border-dark');
          $(this).removeClass('border-dark');
          $(this).addClass('border-danger');

          if(!$("#div-funcionario").is(":visible"))
              $("#div-funcionario").show();


               $.ajaxSetup({
                       headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                         });
                
                   $.ajax({
                      url: "{{ route('getFuncionario') }}",
                      method: 'GET',
                      dataType: "json",
                      data: { servico: valor_servico } ,                  
                      statusCode:{
              422: function(data){
                  console.log(data);
                                             
                },
                200: function(data){                            
                   $("#div-funcionario").children().remove();
                      titulo = '<p class="lead"> Selecione o profissional: </p>';
                      $("#div-funcionario").append(titulo)
                      $.each( data, function( key, val ) {        
                        
                         msg = '<div onclick="selectFuncionario('+ val.id +')" class="funcionario-select card border-dark mt-3 mb-3 mr-3" style="max-width: 13rem; min-width: 09rem; float: left;" data-funcionario="' + val.id + '"> <div class="card-header"><img style="width: 100%;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThSXqxWtOernC1AJcHNjtGo0X45auE3DntSIzaEsQvo6NB1EnD"> </div> <div class="card-body text-dark"><h5 class="card-title">'+val.name+'</h5> </div></div>'   

                        $("#div-funcionario").append(msg)

                    });
                  
                }         
              },                                          
                      
         })
    }   //Flag serviço 


  })


  /* FINAL FUNCTIONS */

	/* MASKS */


	$('#cargo_valor').mask('00000000,00', {reverse: true});
  $('#cliente_cpf').mask('000.000.000-00', {reverse: true});


	/* END MASKS */ 

/* AJAX */
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
