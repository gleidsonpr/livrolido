<?php
namespace App\Http\Controllers\painel;
use App\Models\Painel\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Controllers\StanderdController;
use Illuminate\Validation\Factory;
use Auth;

class EmprestimoController extends StanderdController
{
    protected $request;
    protected $model;
    protected $validator;
    protected $nameView='emprestimo';
    protected $titulo='Emprestimos';
    protected $clausula_orderBy='id';
    
    public function __construct(Request $request,Emprestimo $emprestimo, Factory $validator) {
        $this->request=$request;
        $this->model=$emprestimo;
        $this->validator=$validator;
    }
        public function getIndex()
    {
      $titulo=$this->titulo;
      $data=Auth::user()->emprestimos()->paginate(15);

      return view("painel.{$this->nameView}.index",  compact('data','titulo'));
    }
}