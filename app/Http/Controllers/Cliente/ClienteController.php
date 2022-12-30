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
                    'nome' => 'required',
                    'data_nascimento' => 'required',
                    'status' => 'required',
                    'cpf' => 'required',
                    'telefone' => 'required',
                ],
                [
                    'nome.required' => 'Digite o nome do cliente',
                    'data_nascimento.required' => 'Forneça a data de nascimento',
                    'status.required' => 'Defina o status do cliente',
                    'cpf.required' => 'Digite o CPF do cliente',
                    'telefone.required' => 'Digite o telefone do cliente',
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
                    'nome' => 'required',
                    'data_nascimento' => 'required',
                    'status' => 'required',
                    'cpf' => 'required',
                    'telefone' => 'required',
                ],
                [
                    'nome.required' => 'Digite o nome do cliente',
                    'data_nascimento.required' => 'Forneça a data de nascimento',
                    'status.required' => 'Defina o status do cliente',
                    'cpf.required' => 'Digite o CPF do cliente',
                    'telefone.required' => 'Digite o telefone do cliente',
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
