@extends('layouts.app')

@section('content')
<head>
  <title> Lista de cargos </title>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                  <h1 class="display-3">Lista de cargos</h1>        
                  <hr>
                               <div class='row'>
                                  
                                  <div class='col-md-5'>
                                      <a href="{{route('home')}}"><button class="btn btn-outline-dark">Voltar</button></a>
                                       <a href="{{route('cadastro-cargo')}}"><button class="btn btn-outline-success">Adicionar Cargo</button></a>
                                  </div>
                                 
                                </div>



                            <div class="row"> 
                                <div class="col-md-11">


                                <div class="form-group">

                                  <label for="pesquisa_cargo">Pesquisar por: </label>
                                 
                                  <select id="select_pesquisa" class="form-control" style="width: 20%;">
                                    <option value='1' selected>Nome</option>                                   
                                  </select>                                       
                                  
                                </div>

                                <div class="form-group" style="width: 40%;">      

                                  <input type="text" id="pesquisa_cargo" class="form-control" placeholder="Pesquise aqui">

                                </div>
                                
                            
                              
                              </div>
                                  
                          </div>    
                        

                      
                            <table class="table table-bordered table-hover" id="tabela_cargo">
                                <thead>
                                    <th> Código  </th>
                                    <th> Nome    </th>
                                    <th> Valor    </th>                                  
                                    <th> Editar </th>                                   
                                    <th> Deletar </th>                                  

                                </thead>
                                
                                <tbody>
                                    @foreach($cargos as $c)
                                    <tr>
                                        <td>{{$c->id}}</td>
                                        <td class="td_nome_cargo">{{$c->nome}}</td>
                                        <td>{{$c->valor}}</td>                                  
                                        <td><a > <button class="btn btn-primary" value='{{$c->id}}'> Editar </button> </a></td>
                                        <td><a > <button class="btn btn-danger" value='{{$c->id}}'> Deletar </button> </a></td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>

                           
                    
                          
                                        
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
<<div class="modal fade" id="editModalcargo" tabindex="-1" role="dialog" aria-labelledby="titulo_cargo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_cargo">Editar cargo</h5>

        <button type="button"  data-dismiss="modal" class="close"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" id='frm_edt'>
          
           
           <input type="hidden" name="id_cargo" id='id_cargo' value="">
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