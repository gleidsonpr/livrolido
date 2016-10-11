<?php
namespace App\Http\Controllers\painel;
use App\Models\Painel\Leitura;
use Illuminate\Http\Request;
use App\Http\Controllers\StanderdController;
use Illuminate\Validation\Factory;
use DB;
use Auth;

class LeituraController extends StanderdController
{
    protected $request;
    protected $model;
    protected $validator;
    protected $nameView='leitura';
    protected $titulo='Leituras';
    protected $clausula_orderBy='id';
    
    public function __construct(Request $request,Leitura $leitura, Factory $validator) {
        $this->request=$request;
        $this->model=$leitura;
        $this->validator=$validator;
    }
    public function getIndex()
    {
      $titulo=$this->titulo;
      $data=Auth::user()->leituras()->paginate(15);
      
      return view("painel.{$this->nameView}.index",  compact('data','titulo'));
    }
     public function postAdcionar(){
   
        $dadosForm=$this->request->except('_token');
        $id=$this->request->get('user_id');
        $validator=$this->validator->make($dadosForm,$this->model->rulesAdcionar($id));
        
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
    
}
