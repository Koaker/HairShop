@extends('layouts.app')


@section('content')


<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-1 mt-5">

                  <h1 class="display-3"> Cadastro de usuário</h1> 
                  <hr>
                            @csrf
                            @include('usuario/form/frm-cadastro-usuario')
                            
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


    $("#usuario_tipo").change(function(){

      if($("#usuario_tipo").val() == 1)
        $(".usuario-cargo").show();
      else
         $(".usuario-cargo").hide();
    });

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
            var tipo = $("#usuario_tipo")
            var cargos = $("#usuario_cargos")

                           $.ajaxSetup({
                        headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             }
                          });
            
               $.ajax({
                  url: "{{ route('cadastrarUsuario') }}",
                  method: 'POST',
                  dataType: "json",
                  data: {

                                  nome:                         nome.val(),
                                  email:                        email.val(),
                                  cpf:                          cpf.val(),
                                  senha:                        senha.val(),
                                  senha_confirmation:           senha2.val(),
                                  telefone:                     telefone.val(),
                                  tipo:                         tipo.val(),
                                  cargos:                       cargos.val()
                     
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
                                        $(".usuario-nome").append(msg)

                                    } 

                                     if(key == 'cpf'){
                                        msg = '<div class="invalid-feedback">'+ val +' </div>'
                                        cpf.addClass('is-invalid')                                      
                                        $(".usuario-cpf").append(msg)
                                    }  

                                    if(key == 'senha_confirmation'){
                                        msg = '<div class="invalid-feedback">'+ val +' </div>'
                                        senha2.addClass('is-invalid')                                       
                                        $(".usuario-senha2").append(msg)
                                    }  

                                    if(key == 'senha'){
                                        msg = '<div class="invalid-feedback">'+ val +' </div>'
                                        senha.addClass('is-invalid')                                        
                                        $(".usuario-senha").append(msg)
                                    }

                                    if(key == 'telefone'){
                                        msg = '<div class="invalid-feedback">'+ val +' </div>'
                                        telefone.addClass('is-invalid')                                     
                                        $(".usuario-telefone").append(msg) 
                                    }

                                    if(key == 'email'){
                                        msg = '<div class="invalid-feedback">'+ val +' </div>'
                                        email.addClass('is-invalid')                                        
                                        $(".usuario-email").append(msg) 
                                    }

                                     if(key == 'tipo'){
                                        msg = '<div class="invalid-feedback">'+ val +' </div>'
                                        email.addClass('is-invalid')                                        
                                        $(".usuario-tipo").append(msg) 
                                    }

                                     if(key == 'cargos'){
                                        msg = '<div class="invalid-feedback">'+ val +' </div>'
                                        cargos.addClass('is-invalid')                                        
                                        $(".usuario-cargo").append(msg) 
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