<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model {

    protected $table = 'autores';
    protected $guarded = ['id'];

    public function rulesEditar($id) {
        return $rules=['nome'=>"required|min:3|max:200|unique:autores,nome,$id",];
    }

    public $rules = [
        'nome' => 'required|min:3|max:200|unique:autores',
    ];

    public function getLivros() {
        return $this->belongsToMany('App\Models\Painel\Livro');
    }

}
