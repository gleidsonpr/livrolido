<?php
namespace App\Http\Controllers\painel;
use App\Models\Painel\Loja;
use Illuminate\Http\Request;
use App\Http\Controllers\StanderdController;
use Illuminate\Validation\Factory;

class LojaController extends StanderdController
{
    protected $request;
    protected $model;
    protected $validator;
    protected $nameView='loja';
    protected $titulo='Lojas';
    protected $clausula_orderBy='nome';
    
    public function __construct(Request $request,Loja $loja, Factory $validator) {
        $this->request=$request;
        $this->model=$loja;
        $this->validator=$validator;
    }
    
}
