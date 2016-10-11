<?php
namespace App\Http\Controllers\painel;
use App\Models\Painel\Editora;
use Illuminate\Http\Request;
use App\Http\Controllers\StanderdController;
use Illuminate\Validation\Factory;

class EditoraController extends StanderdController
{
    protected $request;
    protected $model;
    protected $validator;
    protected $nameView='editora';
    protected $titulo='Editoras';
    protected $clausula_orderBy='nome';
    
    public function __construct(Request $request,Editora $editora, Factory $validator) {
        $this->request=$request;
        $this->model=$editora;
        $this->validator=$validator;
    }
    
}
