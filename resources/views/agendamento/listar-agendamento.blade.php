@extends('layouts.app')

@section('content')
<head>
  <title> Lista de agendamentos </title>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header">
                           <div class="card-title">
                            <a href="{{route('home')}}"><button class="btn btn-outline-dark">Voltar</button></a>
                           <p class="mt-3">Lista de agendamentos</p>
                           <hr>
                            </div>


                               <div class='row'>
                                  
                                  <div class='col-md-5'>
                                       <a href="{{route('cadastro-agendamento')}}"><button class="btn btn-success">Agendar novo horário</button></a>
                                  </div>
                                 
                                </div>



                            <div class="row"> 
                                <div class="col-md-12">


                                <div class="form-group">

                                  <label for="pesquisa_agendamento">Pesquisar por: </label>
                                 
                                  <select id="select_pesquisa" class="form-control" style="width: 20%;">
                                    <option value='1' selected>Nome</option>                                   
                                  </select>                                       
                                  
                                </div>

                                <div class="form-group" style="width: 40%;">      

                                  <input type="text" id="pesquisa_agendamento" class="form-control" placeholder="Pesquise aqui">

                                </div>
                                
                            
                              
                              </div>
                                  
                          </div>    
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="tabela_agendamento">
                                <thead>
                                    <th> Código  </th>
                                    <th> Cliente    </th>
                                    <th> Funcionário Resp.    </th>      
                                    <th> Data Agendamento   </th>
                                    <th> Serviços   </th>                                 
                                    <th> Editar </th>                                   
                                    <th> Cancelar </th>                                  

                                </thead>
                                
                                <tbody>
                                    @foreach($agendamentos as $a)
                                    <tr>
                                        <td>{{$a->id}}</td>
                                        <td class="td_nome_agendamento">{{$a->user_name}}</td>
                                        <td>{{$a->funcionario}}</td>  

                                        <?php $data_agendamento = date("d/m/Y", strtotime($a->hora_inicio)); ?>
                                        <td>{{$data_agendamento}}</td> 
                                        
                                        <td>{{$a->service_name}}</td>                                 
                                        <td><a > <button class="btn btn-primary" value='{{$a->id}}'> Editar </button> </a></td>
                                        <td><a > <button class="btn btn-danger" value='{{$a->id}}'> Deletar </button> </a></td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>

                           
                        </div>
                          
                    </div>                    
                </div>
            </div>
        </div>
    </main>
</body>

<!-- Scripts -->


<script>
  

</script>







<!-- MODAL EDIT -->
<!-- 
<<div class="modal fade" id="editModalagendamento" tabindex="-1" role="dialog" aria-labelledby="titulo_agendamento" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_agendamento">Editar agendamento</h5>

        <button type="button"  data-dismiss="modal" class="close"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" id='frm_edt'>
          
           
           <input type="hidden" name="id_agendamento" id='id_agendamento' value="">
        </form>
         <button id='edt_submit' class="btn btn-primary">Salvar alterações</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div> -->
<!-- END MODAL EDIT -->

@endsection
