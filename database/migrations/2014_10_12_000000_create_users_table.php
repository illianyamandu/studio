<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255);
            $table->string('cpf', 50);
            $table->integer('status')->default(1);
            $table->string('rg', 50)->nullable();
            $table->string('endereco', 300)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('telefone', 50);
            $table->string('instagram', 255)->nullable();
            $table->date('data_nascimento');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
