<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class MinhaEstante extends Model {
    protected $table = 'minha_estante';
    protected $guarded = ['id'];
    static $rules = [
        'livro_id' => 'required',
        'user_id' => 'required',
    ];


}
