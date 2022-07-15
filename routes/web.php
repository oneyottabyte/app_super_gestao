<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return 'welcome';
});

Route::get('/sobre', function () {
    return 'Sobre';
});

Route::get('/contato', function () {
    return 'Contato';
});

Route::get(
    '/contato/{nome}/{categoria_id}',
    function (
        string $nome = 'Sem Nome', //se não passar ela vai para contato
        int $categoria_id = 1
    ) {
        return "<h1> Dados pela url: $nome - $categoria_id </h1>";
    }
)->where('nome','[A-Za-z]+')->where('categoria_id', '[0-9]+');

Route::get('/rota1', function () {
    return '1';
})->name('site.rota1');

Route::get('/rota2', function () {
return redirect()->route('site.rota1');
})->name('site.rota2');

Route::redirect('/rota2','/rota1');

Route::fallback(function(){
    echo "404 Não encontrada.  <a href='/'>INDEX</a>";
});
*/

Route::get('/', [\App\Http\Controllers\PrincipalController::class, 'principal'])->name('site.index');
Route::get('/sobre', [\App\Http\Controllers\SobreController::class, 'sobre'])->name('site.sobre');
Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.contato');
Route::get('/login', [\App\Http\Controllers\PrincipalController::class, 'principal'])->name('site.login');

Route::prefix('/app')->group(function () {
    Route::get('/clientes', [\App\Http\Controllers\SobreController::class, 'sobre'])->name('app.clientes');
    Route::get('/fornecedores', [\App\Http\Controllers\FornecedorController::class, 'index'])->name('app.fornecedores');
    Route::get('/produtos', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('app.produtos');
});

Route::fallback(function(){
    echo "404 Não encontrada.  <a href='/'>Ir para INDEX</a>";
});

Route::get('/teste/{p1}/{p2}', [\App\Http\Controllers\TesteController::class, 'teste'])->name('teste');
