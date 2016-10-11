<?php

namespace App\Http\Controllers\painel;

use DB;
use App\Models\Painel\Livro;
use App\Models\Painel\Editora;
use App\Models\Painel\Genero;
use App\Models\Painel\Autor;
use App\Models\Painel\Loja;
use App\Models\Painel\MinhaEstante;
use App\Models\Painel\AutoresLivros;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\Factory;

class LivroController extends Controller {

    private $request;
    private $livro;
    private $estante;
    private $validator;

    public function __construct(Request $request, Livro $livro, MinhaEstante $estante, Factory $validator) {
        $this->request = $request;
        $this->livro = $livro;
        $this->estante = $estante;
        $this->validator = $validator;
    }

    private $qnt_por_pagina = 15;

    public function getIndex() {//injeção de dependencia


        $livros = $this->livro->orderBy('titulo')->paginate($this->qnt_por_pagina);
        $titulo = "Cadastrar ou editar livro";
        $editoras = Editora::orderBy('nome')->lists('nome', 'id');
        $generos = Genero::orderBy('genero')->lists('genero', 'id');
        $autores = Autor::orderBy('nome')->lists('nome', 'id');
        $lojas = Loja::orderBy('nome')->lists('nome', 'id');
        return view('painel.livro.index', compact('livros', 'editoras', 'titulo', 'generos', 'autores', 'lojas'));
    }

    public function postAdcionarLivro() {
        $dadosForm = $this->request->except('autor_id', '_token','isbn_buscar');
        $validator = $this->validator->make($dadosForm, Livro::$rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $displayErrors = '';
            foreach ($messages->all("<p>:message</p>") as $error) {
                $displayErrors = $error;
            }
            return $displayErrors;
        }
        $id = $this->livro->create($dadosForm)->id;
        if ($this->request->get('autor_id') != null) {
            if ($this->livro->find($id)->getAutor()->sync($this->request->get('autor_id'))) {

                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }

    public function getEditarLivro($id) {
        return $this->livro->find($id)->toJson();
    }
    public function getView($id) {
        $livro=$this->livro->find($id);
        return view('painel.livro.view', compact('livro'));
    }

    public function postEditarLivro($id) {
        $rulesEditar = [
            'titulo' => "required|min:3|max:200|unique:livros,titulo,$id",
        ];

        $dadosForm = $this->request->except('autor_id', '_token','isbn_buscar');

        $validator = $this->validator->make($dadosForm, $rulesEditar);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $displayErrors = '';
            foreach ($messages->all("<p>:message</p>") as $error) {
                $displayErrors = $error;
            }
            return $displayErrors;
        }

        $this->livro->find($id)->update($dadosForm);
        if ($this->request->get('autor_id') != null) {
            if ($this->livro->find($id)->getAutor()->sync($this->request->get('autor_id'))) {

                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }

    public function getDeletarLivro($id) {
        if ($this->livro->find($id)->delete()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getPesquisar($palavraPesquisa = '') {
        $livros = $this->livro->where('titulo', 'LIKE', "%{$palavraPesquisa}%")->paginate($this->qnt_por_pagina);
        $titulo = "Resultado da busca por: {$palavraPesquisa}";
        $editoras = Editora::lists('nome', 'id');
        $generos = Genero::lists('genero', 'id');
        $autores = Autor::lists('nome', 'id');
        $lojas = Loja::orderBy('nome')->lists('nome', 'id');

        return view('painel.livro.index', compact('livros', 'titulo', 'editoras', 'palavraPesquisa', 'generos', 'autores','lojas'));
    }

    public function missingMethod($params = array()) {
        return view('painel.404.index');
    }



}
