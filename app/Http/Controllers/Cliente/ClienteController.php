<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utils\FormReturn;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\DataTables\ClienteDataTable;
use Illuminate\Support\Facades\View;

class ClienteController extends Controller
{
    public function index(ClienteDataTable $dataTable)
    {
        return $dataTable->render('cliente.index');
    }

    public function form(){
        return view('cliente.form');
    }

    public function store(Request $request)
    {
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
            FormReturn::ReturnError($validator->errors);
        }
        DB::beginTransaction();
        $data = [
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'status' => $request->status,
            'data_nascimento' => $request->data_nascimento,
            'instagram' => $request->instagram,
            'rg' => $request->rg,
            'endereco' => $request->endereco,
        ];

        Cliente::create($data);
        DB::commit();

        return redirect()->route('cliente.index');
        // FormReturn::ReturnSuccess('Cliente cadastrado com sucesso!', 200);
    }


    public function formEdit(ClienteDataTable $dataTable, $id){
        return $dataTable->render('cliente.index');
    }
}
