<?php
namespace App\Http\Controllers\perfil;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\Factory;

class PerfilController extends Controller {
    private $request;
    private $usuario;
    private $validator;
    public function __construct(Request $request,User $usuario, Factory $validator) {
        $this->request=$request;
        $this->usuario=$usuario;
        $this->validator=$validator;
    }

    public function getIndex($user_perfil) {
      
       $usuario_atual=$this->usuario->where('user','=',"{$user_perfil}")->first();
        if($usuario_atual== null)
        {
           return redirect('/')->withErrors("Usuário não encontrado");
        }
        else{
        $meusLivros=$usuario_atual->getlivros()->paginate(10);
        $titulo = "Perfil do usuário";
        $leituras = DB::table('livros')
            ->join('leituras', 'livros.id', '=', 'leituras.livro_id')
                ->where('leituras.user_id','=',$usuario_atual->id)
                ->where('leituras.lido','=','n')//condição uque livro nao foi lido '=n' lido '=s'
            ->get();
        
        return view('perfil.index', compact('titulo', 'meusLivros','leituras','usuario_atual'));
        }
    }
    public function postUploadFotoPerfil(Request $request){
        $rules=['image'=>'required|image|max:1024*1024*1',];
        $messages=[
            'image.required'=>'Imagem requerida',
            'image.image'=>'Formato não permitido',
            'image.max'=>'Tamanho máximo 2mb'
        ];
        $validator= Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect("/perfil/".$this->request->get('user'))->withErrors($validator);
        }
        else{
            
            $name=str_random(30).'-'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move('assets/fotoPerfil',$name);
            $user = new User;
            $user->where('id','=',Auth::user()->id)
                    ->update(['foto'=>'assets/fotoPerfil/'.$name]);
            return redirect("/perfil/".$this->request->get('user'))->withErrors($validator);
            
        }
        
    }


    public function missingMethod($params = array()) {
        return view('painel.404.index');
    }

}
