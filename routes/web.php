<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Products;
use App\Http\Controllers\Attributes;
use App\Http\Controllers\Stock;

Route::get('/', function(){
    return redirect('/produtos');
});
Route::get('/produtos', [Products::class, 'index']);
Route::get('/atributos', [Attributes::class, 'index']);
Route::post('/atributos', [Attributes::class, 'store']);

Route::get('/atributos/{id}', [Attributes::class, 'edit']);
Route::get('/atributos/excluir/{id}', [Attributes::class, 'destroy']);
Route::post('/atributos/update/{id}', [Attributes::class, 'update']);
Route::post('/atributos/deleteItems/{id}', [Attributes::class, 'deleteItems']);

Route::get('/produtos/atributos', [Products::class, 'attributes']);
Route::get('/produtos/getAll', [Products::class, 'getAll']);
Route::get('/produtos/attributosItens/{id}', [Products::class, 'attributesItems']);
Route::post('/produtos/adicionar', [Products::class, 'store']);
Route::get('/produtos/excluir/{id}', [Products::class, 'destroy']);

Route::get('/estoque', [Stock::class, 'index']);
Route::get('/estoque/entrada', [Stock::class, 'entry']);
Route::get('/estoque/adicionarEntrada/{id}', [Stock::class, 'addEntry']);
Route::get('/estoque/getAllAttributesProduct/{id}', [Stock::class, 'getAllAttributesProduct']);
Route::post('/estoque/adicionar', [Stock::class, 'store']);
