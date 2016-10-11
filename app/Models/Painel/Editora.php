<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
 protected $guarded=['id'];
 public function rulesEditar ($id){
      return $rules=['nome'=>"required|min:3|max:200|unique:editoras,nome,$id",];
 }
     public $rules=[
    'nome'=>'required|min:3|max:200|unique:editoras',
    
    ];
        public function getLivros(){
        return $this->hasMany('App\Models\Painel\Livro');
    }
}