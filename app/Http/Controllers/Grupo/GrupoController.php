<?php

namespace App\Http\Controllers\Grupo;

use App\DataTables\GrupoDataTable;
use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Utils\FormReturn;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    public function index(GrupoDataTable $dataTable){
        return $dataTable->render('grupo.index');
    }

    public function store(Request $request){
        try{
            $validator = Validator::make(
                $request->all(),
                [
                    'nome' => 'required|max:255|unique:grupos,nome',
                    'titulo' => 'required|max:255',
                    'descricao' => 'max:300',                
                ],
                [
                    'nome.required' => 'Digite o nome do grupo de acesso',
                    'nome.unique' => 'Já existe um registro com esse nome',
                    'nome.max' => 'O nome não pode conter mais do que 255 caracteres',
                    'titulo.required' => 'Digite o título do grupo de acesso',
                    'titulo.max' => 'O título não pode conter mais do que 255 caracteres',
                    'descricao.max' => 'A descrição não pode conter mais do que 300 caracteres',
                ],
            );
            if ($validator->fails()) {
                return FormReturn::ReturnError($validator->errors());
            }
            DB::beginTransaction();
            $data = [
                'nome' => $request->nome,
                'titulo' => $request->titulo,
                'descricao' => $request->descricao
            ];
            
            Grupo::create($data);
            DB::commit();

            return FormReturn::ReturnSuccess('Grupo cadatrado com sucesso!!');
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
                    'titulo' => 'required|max:255',           
                    'descricao' => 'max:300',                
                ],
                [
                    'nome.required' => 'Digite o nome do grupo de acesso',
                    'nome.max' => 'O nome não pode conter mais do que 255 caracteres',
                    'titulo.required' => 'Digite o título do grupo de acesso',
                    'titulo.max' => 'O título não pode conter mais do que 255 caracteres',
                    'descricao.max' => 'A descrição não pode conter mais do que 300 caracteres',
                ],
            );
            if ($validator->fails()) {
                return FormReturn::ReturnError($validator->errors());
            }
            DB::beginTransaction();
            $data = [
                'nome' => $request->nome,
                'titulo' => $request->titulo,
                'descricao' => $request->descricao
            ];
            
            $grupo = Grupo::findOrFail($id);

            if(strcmp($grupo->nome, $request->nome) === 0){
                unset($data['nome']);
            }else{
                $duplicado = Grupo::query()->where('nome', '=', $request->nome)->first();
                if(isset($duplicado)){
                    return FormReturn::ReturnError(['error' => ['Já existe um registro com esse nome']]);
                }
            }

            $grupo->update($data);

            DB::commit();
    
            return FormReturn::ReturnSuccess('Grupo atualizado com sucesso');
        }catch(Exception $e){
            DB::rollBack();
            $msg = $e->getMessage() != "" ? $e->getMessage() : 'Ocorreu um erro, informe ao administrador';
            return FormReturn::ReturnError(['error' => [$msg]]);
        }
    }

    public function delete($id){
        try{
            DB::beginTransaction();
            Grupo::findOrFail($id)->delete();
            DB::commit();
            return FormReturn::ReturnSuccess('Registro removido com sucesso!');
        }catch(Exception $e){
            DB::rollBack();
            $msg = $e->getMessage() != "" ? $e->getMessage() : 'Ocorreu um erro, informe ao administrador';
            return FormReturn::ReturnError(['error' => [$msg]]);
        }
    }
}
