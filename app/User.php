<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use Authenticatable,
        Authorizable,
        CanResetPassword;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password','user'];

    protected $hidden = ['password', 'remember_token'];

    public function getLivros() {
        return $this->belongsToMany('App\Models\Painel\Livro',"minha_estante");
    }
    public function leituras(){
        return $this->hasMany('App\Models\Painel\Leitura');
    }    
    
    public function emprestimos() {
        return $this->hasMany('App\Models\Painel\Emprestimo',"dono_livro_id","id");
    }
    

}
