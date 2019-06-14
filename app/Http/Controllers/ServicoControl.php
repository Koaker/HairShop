<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\servicos;
use App\CargosServicos;
use DB;
class ServicoControl extends Controller
{


    public function funcionarioServico(){

    }




    public function formCadastroServico(){
        return view('servico/cadastro-servico');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $servicos = Servicos::paginate(5);
        
        return view('servico/listar-servico', compact('servicos'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          $mensagens = [            
            'servico_nome.required' => 'O nome é obrigatório',
            'servico_nome.unique' => 'Esse serviço já existe',
            'servico_valor.required' => 'O valor é obrigatório',
            'servico_duracao.required' => 'A duração é obrigatória',
            'cargo_servico.required' => 'Você deve selecionar no mínimo um cargo para este serviço'
        ];

        $campos = [

            'servico_nome' => 'bail|required|unique:servicos,nome',
            'servico_valor' => 'bail|required',
            'servico_duracao' => 'bail|required',
            'cargos' => 'bail|required'
           
        ];


         $request->validate($campos, $mensagens);



         $valor = str_replace(',','.',$request->input('servico_valor') ); 

        $servicos = new servicos();
        $servicos->nome = $request->input('servico_nome');
        $servicos->valor = $valor;
        $servicos->duracao = $request->input('servico_duracao');
  
        $servicos->save();
        $servico_id = DB::getPdo()->lastInsertId();

        foreach ($request->input('cargos') as $key) {
            $cargosServicos = new CargosServicos();
            $cargosServicos->servico = $servico_id; 
            $cargosServicos->cargo = $key;
            $cargosServicos->save();
        }

        
     

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
