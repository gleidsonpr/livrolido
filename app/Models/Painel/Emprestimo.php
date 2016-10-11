<?php
namespace App\Models\Painel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Emprestimo extends Model {
    protected $table = 'emprestimos';
    protected $guarded = ['id'];
    public $rules = [
        'livro_id' => 'required',
        'user_id' => 'required',
        'dono_livro_id' => 'required',
        'data_emprestimo' => 'required',
    ];
    public function user() {
        //relacionamento elemento de outra tabela retornar
        return $this->hasOne('App\User',"id","user_id");
    }
    public function livro() {
        return $this->hasOne('App\Models\Painel\Livro',"id","livro_id");
    }


}
