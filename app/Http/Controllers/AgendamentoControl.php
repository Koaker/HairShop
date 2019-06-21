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
            $servico = servicos::find($request->input('servico'));
            $cliente     = $request->input('cliente');
        // $mensagens = [            
        //     'nome.required' => 'O nome é obrigatório',
        //     'nome.string' => 'Você deve digitar um texto', 
        //     'cpf.unique' => 'O CPF já está cadastrado para outro usuário',
        //     'cpf.min' => 'CPF inválido',
        //     'cpf.required' => 'O CPF é obrigatório',
        //     'email.required' => 'O e-mail é obrigatório',
        //     'email.email' => 'O e-mail informado é inválido',
        //     'email.unique' => 'O e-mail já está cadastrado para outro usuário',
        //     'senha.required' => 'A senha é obrigatória',
        //     'senha.confirmed' => 'A senha não é igual a confirmação de senha',
        //     'senha_confirmation.required' => 'A confirmação de senha é obrigatória',
        //     'senha_confirmation.same' => 'A confirmação da senha não é igual a senha',
        //     'telefone.required' => 'O telefone é obrigatório',
        //     'telefone.max' => 'Telefone inválido! O telefone deve ser informado junto com o DDD',
        //     'telefone.min' => 'Telefone inválido! O telefone deve ser informado junto com o DDD',
        //     'tipo.required' => "Você deve selecionar um tipo",

        // ];

        // $campos = [

        //     'nome' => 'bail|required|string',
        //     'cpf' => 'bail|required|unique:users,cpf|min:14|max:14',
        //     'email' => 'bail|required||email|unique:users,email',
        //     'senha' => 'bail|required|confirmed',
        //     'senha_confirmation' => 'bail|required|same:senha',
        //     'telefone' => 'bail|required|max:15|min:15',
        //     'tipo' => 'bail|required'
        // ];
            
                // cliente_cpf
                // serviço
                // funcionario
                // data_hora



            $dia = $request->input('data_hora');
            $hora = $request->input('horario_momento');

            $soma= '+'.$servico->duracao.' minute';

            $datahora_inicio = $dia . " ". $hora;
            $datahora_inicio = date('Y-m-d H:i:s', strtotime($datahora_inicio));


            $agenda->cliente = $cliente;//$request->input('cliente');
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
