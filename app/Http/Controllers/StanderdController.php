<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class StanderdController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected   $qnt_por_pagina=15;
    
    public function getIndex()//injeção de dependencia
    {
      $data=$this->model->orderBy("$this->clausula_orderBy")->paginate($this->qnt_por_pagina);
      $titulo=$this->titulo;
     return view("painel.{$this->nameView}.index",  compact('data','titulo'));
    }

    public function postAdcionar(){
   
        $dadosForm=$this->request->except('_token');
        $validator=$this->validator->make($dadosForm,$this->model->rules);
        
        if($validator->fails()){
            $messages=$validator->messages();
            $displayErrors='';
            foreach($messages->all("<p>:message</p>") as $error){
                $displayErrors=$error;
            }
            return $displayErrors;
        }
        if($this->model->create($dadosForm)){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function getEditar($id)
    {
        return $this->model->find($id)->toJson();
    }
    public function postEditar($id){
        $dadosForm=$this->request->except('_token');
        $validator=$this->validator->make($dadosForm,$this->model->rulesEditar($id));
        if($validator->fails()){
            $messages=$validator->messages();
            $displayErrors='';
            foreach($messages->all("<p>:message</p>") as $error){
                $displayErrors=$error;

            }
            return $displayErrors;
        }
        if($this->model->find($id)->update($dadosForm)){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function getDeletar($id)
    {
        if($this->model->find($id)->delete()){
            return 1;

        }
        else{
            return 0;
        }
    }
    public function getPesquisar($palavraPesquisa=''){
       $data= $this->model->where("$this->clausula_orderBy",'LIKE',"%{$palavraPesquisa}%")->paginate($this->qnt_por_pagina);
       $titulo="Resultado da busca por: {$palavraPesquisa}";
       return view("painel.{$this->nameView}.index",  compact('data','titulo','palavraPesquisa'));
    }
    public function missingMethod($params=array())
    {
       return view('painel.404.index');
    }
}
