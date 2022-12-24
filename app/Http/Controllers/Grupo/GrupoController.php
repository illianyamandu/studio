<?php

namespace App\Http\Controllers\Grupo;

use App\DataTables\GrupoDataTable;
use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Utils\FormReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    public function index(GrupoDataTable $dataTable){
        return $dataTable->render('grupo.index');
    }

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required|max:255',                
                'descricao' => 'max:300',                
            ],
            [
                'nome.required' => 'Digite o nome do grupo de acesso',
                'nome.max' => 'O nome não pode conter mais do que 255 caracteres',
                'descricao.max' => 'A descrição não pode conter mais do que 300 caracteres',
            ],
        );
        if ($validator->fails()) {
            FormReturn::ReturnError($validator->errors);
        }
        DB::beginTransaction();
        $data = [
            'nome' => $request->nome,
            'descricao' => $request->descricao
        ];
        
        Grupo::create($data);
        DB::commit();

        return redirect()->route('grupo.index');
    }
}
