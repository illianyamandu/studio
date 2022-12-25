<?php

namespace App\Http\Controllers\Usuario;

use App\DataTables\GrupoUsuarioDataTable;
use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\User;
use App\Utils\FormReturn;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsuarioGrupoController extends Controller
{
    public function index(GrupoUsuarioDataTable $dataTable){
        return $dataTable->render('grupousuario.index');
    }

    public function store(Request $request){
        try{
            $validator = Validator::make(
                $request->all(),
                [
                    'grupo' => 'required',
                ],
                [
                    'grupo.required' => 'É obrigatório selecionar um grupo',
                ],
            );
            if ($validator->fails()) {
                FormReturn::ReturnError($validator->errors);
            }
            DB::beginTransaction();
            $grupo = Grupo::findOrFail($request->grupo);
            $user = User::findOrFail($request->user);
            $user->grupo()->sync([$grupo->id]);
            
            DB::commit();
    
            return redirect()->route('grupousuario.index');
        }catch(Exception $e){
            return redirect()->route('grupousuario.index');
        }
    }

    public function update(Request $request, $id){
        return;
    }
    
    public function delete($id){
        return;
    }


}
