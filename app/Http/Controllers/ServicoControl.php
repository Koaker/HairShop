<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\servicos;
class ServicoControl extends Controller
{


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
            'nome.required' => 'O nome é obrigatório',
            'nome.unique' => 'Esse serviço já existe',
            'valor.required' => 'O valor é obrigatório'
        
        ];

        $campos = [

            'nome' => 'bail|required|unique:servicos,nome',
            'valor' => 'bail|required'
           
        ];


         $request->validate($campos, $mensagens);



         $valor = str_replace(',','.',$request->input('valor') ); 

        $servicos = new servicos();
        $servicos->nome = $request->input('nome');
        $servicos->valor = $valor;
  
        $servicos->save();
        
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
