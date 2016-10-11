<?php
namespace App\Http\Controllers\painel;
use App\Models\Painel\Autor;
use Illuminate\Http\Request;
use App\Http\Controllers\StanderdController;
use Illuminate\Validation\Factory;

class AutorController extends StanderdController
{
    protected $request;
    protected $model;
    protected $validator;
    protected $nameView='autor';
    protected $titulo='Autores';
    protected $clausula_orderBy='nome';
    
    public function __construct(Request $request,Autor $autor, Factory $validator) {
        $this->request=$request;
        $this->model=$autor;
        $this->validator=$validator;
    }
    
}
