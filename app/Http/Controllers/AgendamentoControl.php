<?php

namespace App\Http\Controllers;
use App\agendamentos;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\servicos;
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
        //$agendamentos = new agendamentos();
        
         $agendamentos = DB::table('agendamentos')
          ->selectRaw(" agendamentos.*, users.name as user_name, servicos.nome as service_name")
          ->join('users', 'users.id', '=', 'agendamentos.cliente')
          ->join('servicos', 'servicos.id', '=', 'agendamentos.servico')->get();  
           
        //$agendamentos = agendamentos::all();
           
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
            $servico = servicos::find((int)$request->input('servico'));
            $cliente     = $request->input('cliente');
     
            if($request->input('web')){

            $usuario_consulta = DB::table('users')
            ->selectRaw("id")
            ->whereRaw( "cpf = '$cliente'")->first();   
         
            if($usuario_consulta)
                $usuario = $usuario_consulta->id;
            else
                return json_encode("Usuário não encontrado");
        }

        else{
            $usuario = $request->input('cliente');
        }

        if(!$usuario)
            return json_encode("Sua sessão expirou");



            $dia = $request->input('data_hora');
            $hora = $request->input('horario_momento');

             $soma= '+'.$servico->duracao.' minute';

            $datahora_inicio = $dia . " ". $hora;
            $datahora_inicio = date('Y-m-d H:i:s', strtotime($datahora_inicio));


            $agenda->cliente = $usuario;//$request->input('cliente');
            $agenda->funcionario = $request->input('funcionario');
            $agenda->hora_inicio = $datahora_inicio;  


            $agenda->hora_final =  date('Y-m-d H:i:s', strtotime($soma,strtotime($datahora_inicio)));
            $agenda->solicitacao_agendamento = 1;
            $agenda->servico = $request->input('servico');
            
            if($agenda->save())
                return json_encode("sucesso");
            else
                return json_encode("false");


        
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
