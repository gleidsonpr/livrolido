<?php
namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use App\Models\Painel\Livro;
use App\Models\Painel\Editora;
use App\Models\Painel\Genero;
use App\Models\Painel\Autor;
class PainelController extends Controller
{
   
    public function getIndex()
    {
        $total_livros= Livro::all()->count();
        $total_editoras= Editora::all()->count();
        $total_generos= Genero::all()->count();
        $total_autores= Autor::all()->count();
     
      return view('painel.home.index', compact('total_livros','total_editoras','total_generos','total_autores'));
    }
    
    public function getPerfil()
    {
        return view('painel.perfil.index');
    }
    

    public function missingMethod($parameters = array()) {
        return view('painel.404.index');
    }
}