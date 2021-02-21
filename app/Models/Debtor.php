<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'data_nascimento',
        'endereco',
        'descricao_titulo',
        'valor',
        'data_vencimento',
        'updated',
        'created_at',
        'updated_at'
    ];
}
