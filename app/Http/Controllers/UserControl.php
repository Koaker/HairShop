<?php


namespace App\Http\Controllers;
use App\User;
use App\funcionarioCargo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class UserControl extends Controller
{



    public function retornaHorario(Request $request){
       
        $horario = array('09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00');

        $horario_banco = array();

        $horario_disponivel = DB::table('agendamentos','hora_inicio', 'hora_final')           
            ->where('funcionario', $request->input('funcionario') )          
            ->get();


        $horario_disponivel = (array)$horario_disponivel;

        foreach ($horario_disponivel as $key) {

            foreach ($key as $row) {
                
                $horario_banco[] = date("H:i", strtotime($row->hora_final));
                $horario_banco[] = date("H:i", strtotime($row->hora_inicio));

            }
        }

        if($horario_banco){
            $resultado = array_diff($horario, $horario_banco);
        } else{
            $resultado = $horario;
        }
        
      
         $r = new \stdClass();
         $r->horarios = $resultado;
        
        return json_encode($r);
    }

    public function retornaFuncionarioServico(Request $request){
        $funcionario = DB::table('cargos_servicos')
            ->join('funcionario_cargo','funcionario_cargo.cargo', '=', 'cargos_servicos.cargo')
            ->join('users', 'users.id', '=', 'funcionario_cargo.funcionario')
            ->where('cargos_servicos.servico', $request->input('servico') )
            ->groupBy('users.id')
            ->get();

            return $funcionario->toJson();

    }


    public function formCadastroCliente(){
         return view('usuario/cadastro-cliente');
    }

    public function formCadastroUsuario(){
         return view('usuario/cadastro-usuario');
    }


    public function index()
    {
        $user = User::all();
        return $user->toJson();
    }

    public function indexWeb(){

        $user = User::all();
        return view('usuario/listar-usuario', compact('user'));
    }


    public function CadastroUsuario(Request $request){

        $user = new User();
        
        $mensagens = [            
            'nome.required' => 'O nome é obrigatório',
            'nome.string' => 'Você deve digitar um texto', 
            'cpf.unique' => 'O CPF já está cadastrado para outro usuário',
            'cpf.min' => 'CPF inválido',
            'cpf.required' => 'O CPF é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'O e-mail informado é inválido',
            'email.unique' => 'O e-mail já está cadastrado para outro usuário',
            'senha.required' => 'A senha é obrigatória',
            'senha.confirmed' => 'A senha não é igual a confirmação de senha',
            'senha_confirmation.required' => 'A confirmação de senha é obrigatória',
            'senha_confirmation.same' => 'A confirmação da senha não é igual a senha',
            'telefone.required' => 'O telefone é obrigatório',
            'telefone.max' => 'Telefone inválido! O telefone deve ser informado junto com o DDD',
            'telefone.min' => 'Telefone inválido! O telefone deve ser informado junto com o DDD',
            'tipo.required' => "Você deve selecionar um tipo",

        ];

        $campos = [

            'nome' => 'bail|required|string',
            'cpf' => 'bail|required|unique:users,cpf|min:14|max:14',
            'email' => 'bail|required||email|unique:users,email',
            'senha' => 'bail|required|confirmed',
            'senha_confirmation' => 'bail|required|same:senha',
            'telefone' => 'bail|required|max:15|min:15',
            'tipo' => 'bail|required'
        ];



         switch ((int)$request->input('tipo')) {
             case 0:
                $user->cliente = 0;
                break;
            case 1:
                //Usuário normal
                $user->funcionario = 1;
                $mensagens['cargos.required'] = 'Você deve selecionar no mínimo um cargo!';
                $campos['cargos'] = 'bail|required';
                break;
             case 2:
                //Usuário administrador
                $user->funcionario = 2;
                break;
            
            default:
                $user->cliente = 0;
                break;
        }



        $request->validate($campos, $mensagens);





        
        $user->name = $request->input('nome');
        $user->cpf = $request->input('cpf');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('senha'));
        $user->telefone = $request->input('telefone');                
        $user->ativo = 1;

       

        $r = new \stdClass();

        if( $user->save() ){

            if($user->funcionario == 1){

                $user_id = DB::getPdo()->lastInsertId();            
                foreach ($request->input('cargos') as $key) {
                    $cargos = new funcionarioCargo();
                    $cargos->funcionario = $user_id;
                    $cargos->cargo = $key;
                    $cargos->save(); 
                }
                

            }

            $r->mensagem = "O usuário foi cadastrado com sucesso";
            $t->sucesso[] = $r;
            return json_encode($t);

        }  else {

            $r->mensagem = "O usuário não foi cadastrado";
            $t->errors[] = $r;
            return json_encode($t);
           
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CadastroCliente(Request $request)
    {


          $mensagens = [            
            'nome.required' => 'O nome é obrigatório',
            'nome.string' => 'Você deve digitar um texto', 
            'cpf.unique' => 'O CPF já está cadastrado para outro usuário',
            'cpf.min' => 'CPF inválido',
            'cpf.required' => 'O CPF é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'O e-mail informado é inválido',
            'email.unique' => 'O e-mail já está cadastrado para outro usuário',
            'senha.required' => 'A senha é obrigatória',
            'senha.confirmed' => 'A senha não é igual a confirmação de senha',
            'senha_confirmation.required' => 'A confirmação de senha é obrigatória',
            'senha_confirmation.same' => 'A confirmação da senha não é igual a senha',
            'telefone.required' => 'O telefone é obrigatório',
            'telefone.max' => 'Telefone inválido! O telefone deve ser informado junto com o DDD',
            'telefone.min' => 'Telefone inválido! O telefone deve ser informado junto com o DDD'
        ];

        $campos = [

            'nome' => 'bail|required|string',
            'cpf' => 'bail|required|unique:users,cpf|min:14|max:14',
            'email' => 'bail|required||email|unique:users,email',
            'senha' => 'bail|required|confirmed',
            'senha_confirmation' => 'bail|required|same:senha',
            'telefone' => 'bail|required|max:15|min:15'
        ];
         $request->validate($campos, $mensagens);





        $user = new User();
        $user->name = $request->input('nome');
        $user->cpf = $request->input('cpf');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('senha'));
        $user->telefone = $request->input('telefone');
        $user->cliente = 1;
        $user->funcionario = 0;
        $user->ativo = 1;

        $r = new \stdClass();
        if( $user->save() ){
            
            $r->mensagem = "O serviço foi cadastrado com sucesso!";
            $t->sucesso[] = $r;
            return json_encode($t);

        }  else {

            $r->mensagem = "O serviço não foi cadastrado!";
            $t->errors[] = $r;
            return json_encode($t);
           
        }
    } // Final do método
       
            
        
    

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
    public function deletarCliente(Request $request)
    {
        $user = User::find($request->input('id'));
        

        if( $user->delete() )
            return json_encode("Deletou com sucesso");
        else
            return json_encode("Não deletou");
    }
}
