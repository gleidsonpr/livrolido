<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Livro extends Model {

    protected $guarded = ['id'];
    static $rules = [
        'titulo' => 'required|min:3|max:200|unique:livros',
        'isbn' => 'required|min:10|max:13',
    ];

    public function getAutor() {
        return $this->belongsToMany('App\Models\Painel\Autor');
    }
    public function getUser() {
        return $this->belongsToMany('App\User');
    }

}
