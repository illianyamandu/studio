<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utils\FormReturn;
use Illuminate\Support\Facades\DB;
use App\DataTables\ClienteDataTable;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class ClienteController extends Controller
{
    public function index(ClienteDataTable $dataTable)
    {
        return $dataTable->render('cliente.index');
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


    public function update(Request $request, $id){
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
            
            if ($validator->fails()) {
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
            User::findOrFail($id)->update($data);
            DB::commit();
            return FormReturn::ReturnSuccess('Cliente atualizado com sucesso');
        }catch(Exception $e){
            DB::rollBack();
            $msg = $e->getMessage() != "" ? $e->getMessage() : 'Ocorreu um erro, informe ao administrador';
            return FormReturn::ReturnError(['error' => [$msg]]);
        }
    }

    public function delete($id){
        try{
            DB::beginTransaction();
            User::findOrFail($id)->delete();
            DB::commit();
            return FormReturn::ReturnSuccess('Registro apagado com sucesso!');
        }catch(Exception $e){
            DB::rollBack();
            $msg = $e->getMessage() != "" ? $e->getMessage() : 'Ocorreu um erro, informe ao administrador';
            return FormReturn::ReturnError(['error' => [$msg]]);
        }
    }
}
