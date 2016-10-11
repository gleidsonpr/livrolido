<?php
namespace App\Http\Controllers\painel;
use App\Models\Painel\Genero;
use Illuminate\Http\Request;
use App\Http\Controllers\StanderdController;
use Illuminate\Validation\Factory;

class GeneroController extends StanderdController
{
    protected $request;
    protected $model;
    protected $validator;
    protected $nameView='genero';
    protected $titulo='Generos';
    protected $clausula_orderBy='genero';
    
    public function __construct(Request $request,Genero $genero, Factory $validator) {
        $this->request=$request;
        $this->model=$genero;
        $this->validator=$validator;
    }
   
}
