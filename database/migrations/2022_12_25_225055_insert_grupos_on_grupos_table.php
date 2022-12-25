<?php

use App\Models\Grupo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $grupos = [
            [
                'nome' => 'cliente',
                'titulo' => 'CLIENTE',
                'descricao' => 'Cliente do stúdio'
            ],
            [
                'nome' => 'colaborador',
                'titulo' => 'COLABORADOR',
                'descricao' => 'Colaborador do stúdio'
            ],
            [
                'nome' => 'administrador',
                'titulo' => 'ADMINISTRADOR',
                'descricao' => 'AAdministrador do stúdio'
            ],
        ];

        foreach($grupos as $g){
            Grupo::create($g);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
