<?php

namespace App\Http\Controllers\painel;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\Factory;
use App\Models\Painel\Livro;
use App\Models\Painel\Loja;
use App\Models\Painel\MinhaEstante;
use App\User;
use Auth;

class EstanteController extends Controller {

    private $request;
    private $livro;
    private $validator;
    private $usuario;
    private $estante;

    public function __construct(Request $request, MinhaEstante $estante, User $usuario, Livro $livro, Factory $validator) {
        $this->request = $request;
        $this->livro = $livro;
        $this->validator = $validator;
        $this->usuario = $usuario;
        $this->estante = $estante;
    }

    private $qnt_por_pagina = 15; //quantidades de itens a serem exibidos na pagina inicial do painel

    public function getIndex() {//injeção de dependencia
        $user_id = Auth::user()->id;
        $lojas = Loja::orderBy('nome')->lists('nome', 'id');
        $id_livros = $roles = DB::table('minha_estante')->where('user_id', $user_id)->lists('livro_id'); //encontra todos os livros que o usuario já tem na estante para nao mostra-los na consulta
        $livros = DB::table('livros')->whereNotIn('id', $id_livros)->paginate($this->qnt_por_pagina);
        $titulo = "Cadastrar minhas compras de livros";
        return view('painel.estante.index', compact('livros', 'titulo', 'lojas'));
    }

    public function getEditarLivro($id) {
        return $this->livro->find($id)->toJson();
    }

    public function postEditarLivro($id) {
        $rulesEditar = [
            'titulo' => "required|min:3|max:200|unique:livros,titulo,$id",
        ];
        $dadosForm = $this->request->except('idAutor', '_token');

        $validator = $this->validator->make($dadosForm, $rulesEditar);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $displayErrors = '';
            foreach ($messages->all("<p>:message</p>") as $error) {
                $displayErrors = $error;
            }
            return $displayErrors;
        }
        if ($this->livro->find($id)->update($dadosForm) && $this->livro->find($id)->getAutor()->sync($this->request->get('idAutor'))) {

            return 1;
        } else {
            return 0;
        }
    }

    public function getDeletarLivro($id) {
        if ($this->livro->find($id)->delete()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getPesquisar($palavraPesquisa = '') {//mudar a pesquisa
        $livros = $this->livro->where('titulo', 'LIKE', "%{$palavraPesquisa}%")->paginate($this->qnt_por_pagina);
        $titulo = "Resultado da busca por: {$palavraPesquisa}";
        $lojas = Loja::lists('nome', 'id');

        return view('painel.estante.index', compact('livros', 'titulo', 'palavraPesquisa', 'lojas'));
    }

    public function missingMethod($params = array()) {
        return view('painel.404.index');
    }

    public function postAdcionarLivroEstante() {
        $id = $this->request->get('user_id');
        $rulesEstante = [
            'livro_id' => "required|unique:minha_estante,livro_id,NULL,livro_id,user_id,$id",
        ];
        $dadosForm = $this->request->except('_token');
        $validator = $this->validator->make($dadosForm, $rulesEstante);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $displayErrors = '';
            foreach ($messages->all("<p>:message</p>") as $error) {
                $displayErrors = $error;
            }
            return $displayErrors;
        }
        if ($this->estante->create($dadosForm)) {

            return 1;
        } else {
            return 0;
        }
    }

}
