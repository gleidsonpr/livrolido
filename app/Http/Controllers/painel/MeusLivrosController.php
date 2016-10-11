<?php
namespace App\Http\Controllers\painel;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Painel\Emprestimo;
use App\Models\Painel\Leitura;
use App\User;
use Auth;
use Illuminate\Validation\Factory;

class MeusLivrosController extends Controller {

    private $request;
    private $emprestimo;
    private $validator;

    public function __construct(Request $request, Leitura $leitura, Emprestimo $emprestimo, Factory $validator) {
        $this->request = $request;
        $this->emprestimo = $emprestimo;
        $this->validator = $validator;
        $this->leitura = $leitura;
    }

    private $qnt_por_pagina = 15;

    public function getIndex() {//injeção de dependencia
        $usuarios = User::orderBy('name')->lists('name', 'id');
        $meus_livros =Auth::user()->getlivros()->paginate(15);
        $titulo = "Meus livros";
        return view('painel.meus_livros.index', compact('titulo', 'usuarios','meus_livros'));
    }
    public function getPesquisar($palavraPesquisa = '') {
        $autores = $this->autor->where('nome', 'LIKE', "%{$palavraPesquisa}%")->paginate($this->qnt_por_pagina);
        $titulo = "Resultado da busca por: {$palavraPesquisa}";
        return view('painel.meus_livros.index', compact('autores', 'titulo', 'palavraPesquisa'));
    }
    public function missingMethod($params = array()) {
        return view('painel.404.index');
    }

}
