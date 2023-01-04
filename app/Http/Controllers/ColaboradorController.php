<?php

namespace App\Http\Controllers;

use App\DataTables\ColaboradorDataTable;
use App\Models\User;
use App\Utils\FormReturn;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ColaboradorController extends Controller
{
    public function index(ColaboradorDataTable $dataTable){
        // $user = User::join('grupo_user', 'users.id', 'grupo_user.user_id')
        // ->join('grupos', 'grupo_user.grupo_id', 'grupos.id')
        // ->where('grupos.nome', '=', 'cliente')
        // ->get();
        // dd($user);
        return $dataTable->render('colaborador.index');
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make(
                $request->all(),
                [
                    'nome' => 'required|max:255',
                    'data_nascimento' => 'required|date',
                    'status' => 'required|min:0|max:1',
                    'cpf' => 'required|unique:users,cpf',
                    'telefone' => 'required|max:50',
                    'email' => 'unique:users,email|max:255',
                    'instagram' => 'max:255',
                    'endereco' => 'max:300',
                    'rg' => 'max:50,'
                ],
                [
                    'nome.required' => 'Digite o nome do cliente',
                    'nome.max' => 'O nome deve conter, no máximo, 255 caracteres',
                    'data_nascimento.required' => 'Forneça a data de nascimento',
                    'data_nascimento.date' => 'Formato de data inválido',
                    'status.required' => 'Defina o status do cliente',
                    'status.min' => 'Status inválido',
                    'status.max' => 'Status inválido',
                    'cpf.required' => 'Digite o CPF do cliente',
                    'cpf.unique' => 'Já existe um registro com esse CPF',
                    'email.unique' => 'Já existe um registro com esse e-mail',
                    'telefone.required' => 'Digite o telefone do cliente',
                    'telefone.max' => 'O telefone deve conter, no máximo, 50 caracteres',
                    'email.max' => 'O e-mail deve conter, no máximo, 255 caracteres',
                    'instagram.max' => 'O Instagram deve conter, no máximo, 255 caracteres',
                    'endereco.max' => 'O endereço deve conter, no máximo, 300 caracteres',
                    'rg.max' => 'O RG deve conter, no máximo, 50 caracteres',
                ],
            );

            if ($validator->fails()){
                return FormReturn::ReturnError($validator->errors());
            }

            

            DB::beginTransaction();
            $data = [
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'status' => $request->status,
                'data_nascimento' => Carbon::parse($request->data_nascimento)->format('Y-m-d'),
                'instagram' => $request->instagram,
                'rg' => $request->rg,
                'endereco' => $request->endereco,
            ];
            
            User::create($data);
            DB::commit();
    
            return FormReturn::ReturnSuccess('Cliente cadastrado com sucesso!', 200);
        }catch(Exception $e){
            DB::rollBack();
            $msg = $e->getMessage() != "" ? $e->getMessage() : 'Ocorreu um erro, informe ao administrador';
            return FormReturn::ReturnError(['error' => [$msg]]);
        }
    }
}
