<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControladorProduto;
use App\Http\Controllers\ControladorCategoria;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

/*Route::get('/produtos','ControladorProduto@index');
Route::get('/categorias','ControladorCategoria@index');*/

Route::get('/produtos', [ControladorProduto::class, 'index']);
//criar novo produto
Route::get('/produtos/novo', [ControladorProduto::class, 'create']);
//salvar novo produto
Route::post('produtos/novo', [ControladorProduto::class, 'store']);
//editar um produto
Route::get('/produtos/editar/{id}', [ControladorProduto::class, 'edit']);


Route::get('/categorias',[ControladorCategoria::class, 'index']);
//rota para criar novo registro
Route::get('/categorias/novo',[ControladorCategoria::class, 'create']);
//rota para salvar novo registro
Route::post('/categorias/novo',[ControladorCategoria::class, 'store']);
//rota para apagar registro
Route::get('/categorias/apagar/{id}',[ControladorCategoria::class, 'destroy']);
//rota para editar um registro
Route::get('/categorias/editar/{id}',[ControladorCategoria::class, 'edit']);
//Atualizando um registro
Route::post('/categorias/{id}',[ControladorCategoria::class, 'update']);