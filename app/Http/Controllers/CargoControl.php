<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cargos;
class CargoControl extends Controller
{

     public function formCadastroCargo(){
        return view('cargo/cadastro-cargo');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            'nome' => 'bail|required|unique:cargos,nome',
            'valor' => 'bail|required'
           
        ];


         $request->validate($campos, $mensagens);




        $valor = str_replace(',','.',$request->input('valor') ); 
        $cargo = new cargos();
        $cargo->nome = $request->input('nome');
        $cargo->valor = $valor;
  
        $cargo->save();
        
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
