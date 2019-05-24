<?php

namespace App\Http\Controllers;
use App\Agendamentos;
use Illuminate\Http\Request;

class AgendamentoControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function formCadastroAgendamento(){
        return view('agendamento/cadastro-agendamento');
    }

       public function indexWeb(){

        $agendamentos = agendamentos::all();
        return view('agendamento/listar-agendamento', compact('agendamentos'));
    }

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
        //
        $agenda = new agendamentos();
        $agenda->cliente = $request->input('cliente');
        $agenda->funcionario = $request->input('funcionario');
        $agenda->datahora_agendamento = $request->input('data');
        $agenda->confirmado = 0;
        $agenda->situacao = 0;
        $agenda->valor_total = 0;
        $agenda->save();
        
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
