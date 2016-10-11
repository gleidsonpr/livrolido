<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Leitura extends Model {

    protected $table = 'leituras';
    protected $guarded = ['id'];
    public $rules = [
        'livro_id' => 'required|unique:leituras',
        'user_id' => 'required',
    ];

    public function rulesEditar($id) {
        return $rules = [
            'livro_id' => "required|unique:leituras,livro_id,NULL,id,user_id,$id",
            'user_id' => 'required',
        ];
    }
    public function rulesAdcionar($id) {
        return $rules = [
            'livro_id' => "required|unique:leituras,livro_id,NULL,id,user_id,$id",
            'user_id' => 'required',
        ];
    }

    public function livro() {
        return $this->belongsTo('App\Models\Painel\Livro');
    }

}
