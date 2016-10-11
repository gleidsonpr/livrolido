<?php

namespace App\Http\Controllers\Site;
use App\Models\Painel\Livro;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    private $request;
    private $livro;
    private $validator;
    public function __construct(Request $request,Livro $livro, Factory $validator) {
        $this->request=$request;
        $this->livro=$livro;
        $this->validator=$validator;
    }
   

    public function getIndex()//injeção de dependencia
    {
        $livros=$this->livro->paginate(36);
        $titulo="Livro Lido";
        return view('site.inicial',compact('livros','titulo'));
    }
    public function getDetalhes($id)//injeção de dependencia
    {
        
        $titulo="Detalhes do livro";
        $livro=$this->livro->find($id);
     
        if($livro==null)
        { 
            return view('painel.404.erro_detalhe');             
        }
        else
        {
          return view('site.detalhes',compact('titulo','livro'));
        }
    }

    public function missingMethod($parameters = array()) {
        return view('painel.404.erro_site');
    }
    
}
