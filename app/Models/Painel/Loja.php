<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
 protected $guarded=['id'];
    public function rulesEditar($id) {
        return $rules = ['nome'=>"required|min:3|max:200|unique:lojas,nome,$id",];
    }
    public $rules=[
    'nome'=>'required|min:3|max:200|unique:lojas',
    
    ];

}