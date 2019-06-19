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
                                  <button type="submit" class="btn btn-success btn-sm" id="enviarAgendamento"> Enviar </button>
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

          elemento = $(".horario-select[data-id-hora="+ id +"]")

           $(".horario-select").removeClass('border-danger');         
           $(".horario-select").addClass('border-dark');
          
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

            if(!$("#div-agendamento-dia").is(":visible"))
              $("#div-agendamento-dia").show();

            $("#div-agendamento-dia").attr('data-funcionario', id);


}
      

$(document).ready(function($){


  /* FUNCTIONS */


  $("#enviarAgendamento").click(function(){

             var servico ="";
             var funcionario = "";
             var horario_momento = "";

               $('.servicos-select').each(function(){

                  if ( $(this).hasClass( "border-danger" ) ) {
                    console.log('entrou aqui')
                        servico = $(this).data('servico');
                  }
                });


                 $('.funcionario-select').each(function(){

                   if ( $(this).hasClass( "border-danger" ) ) {
                      console.log('entrou funcionario')
                      funcionario = $(this).data('funcionario');
                }

                });



                $('.horario-select').each(function(){

                  if ( $(this).hasClass( "border-danger" ) ) {
                   
                        horario_momento = $(this).data('horario');
                  }
                });
              
       

                // console.log('serv=> ' + servico)
                // console.log('funcionario=> '+funcionario)
                // console.log('horario_momento=> '+horario_momento)
                // console.log('Dia escolihdo=> '+ $("#dia_escolhido").val())
                // console.log('cpf=> '+ $("#cliente_cpf").val())

               
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
                        cliente_cpf: $("#cliente_cpf").val(),
                        servico: servico,
                        funcionario: funcionario,
                        data_hora: $("#dia_escolhido").val(),
                        horario_momento: horario_momento ,

                       } ,                  
                      statusCode:{
              422: function(data){
                  console.log(data);                                             
                },

                200: function(data){                            
                    console.log('data');                  
                }         
              },                                          
                      
         })

  })


  $("#dia_escolhido").change(function(){


            if(!$("#div-data").is(":visible"))
              $("#div-data").show();

            var id = $("#div-agendamento-dia").data('funcionario');
            

            var hora_inicio = $("#dia_escolhido").val();




               $.ajaxSetup({
                       headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                         });
                
                   $.ajax({
                      url: "{{ route('getHorario') }}",
                      method: 'GET',
                      dataType: "json",
                      data: { 
                        funcionario: id,
                        dia_escolhido: hora_inicio
                       } ,                  
                      statusCode:{
              422: function(data){
                  console.log(data);                                             
                },

                200: function(data){                            
                      console.log(data)
                        $("#div-data").children().remove();
                        titulo = '<p class="lead"> Selecione o horário: </p>';
                        $("#div-data").append(titulo)

                        console.log(data);
                      $.each( data.horarios, function( key, val ) {        
                        
                         msg = '<div onclick="selectHorario('+key+')" data-horario="'+val+'" data-id-hora="'+key+'" class="horario-select card border-dark mt-3 mb-3 mr-3" style="max-width: 5rem; min-width: 09rem; float: left;"> <div class="card-header"></div> <div class="card-body text-dark"><h5 class="card-title">'+val+'</h5> </div></div>'   

                        $("#div-data").append(msg)

                        });

                  
                }         
              },                                          
                      
         })
})


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
