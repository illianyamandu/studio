<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = ['nome', 'cpf', 'status', 'rg', 'endereco', 'email', 'telefone', 'instagram', 'data_nascimento'];
    protected $dates = ['data_nascimento', 'created_at', 'updated_at'];
}
