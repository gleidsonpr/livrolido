<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model {

    protected $guarded = ['id'];

    public function rulesEditar($id) {
        return $rules = ['genero' => "required|min:3|max:200|unique:generos,genero,$id",];
    }

    public $rules = [
        'genero' => 'required|min:3|max:200|unique:generos',
    ];

}
