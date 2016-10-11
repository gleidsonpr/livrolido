<?php


Route::group(['prefix' =>'painel','middleware'=>'auth'], function () {
Route::controller('livro','painel\LivroController');
Route::controller('genero','painel\GeneroController');
Route::controller('editora','painel\EditoraController');
Route::controller('autor','painel\AutorController');
Route::controller('loja','painel\LojaController');
Route::controller('emprestimo','painel\EmprestimoController');
Route::controller('leitura','painel\LeituraController');
Route::controller('meus-livros','painel\MeusLivrosController');
Route::controller('estante','painel\EstanteController');
Route::controller('/','painel\PainelController');
});




Route::get('login','Auth\AuthController@getLogin');
Route::post('login','Auth\AuthController@postLogin');
Route::get('logout','Auth\AuthController@getLogout');
Route::get('cadastrar','Auth\AuthController@getRegister');
Route::post('cadastrar','Auth\AuthController@postRegister');

Route::get('recuperar-senha','Auth\PasswordController@getEmail');
Route::post('recuperar-senha','Auth\PasswordController@postEmail');

Route::get('password/reset/{token}','Auth\PasswordController@getReset');
Route::post('resetar-senha/','Auth\PasswordController@postReset');

Route::controller('perfil/{usuario_perfil}','perfil\PerfilController');
Route::controller('/','Site\SiteController');




Route::group(['middleware' => ['web']], function () {

});
