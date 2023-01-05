<?php

use App\Models\Grupo;
use App\Models\User;
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
        $user = User::create([
            'nome' => 'Márcia Gomes Rodrigues',
            'cpf' => '00000000000',
            'rg' => '0000000',
            'endereco' => 'X',
            'telefone' => '00000000000',
            'data_nascimento' => '1974-10-11'
        ]);

        $grupo = Grupo::query()->where('nome', '=', 'administrador')->first();

        $user->grupo()->sync([$grupo->id]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
