<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/validar', [App\Http\Controllers\HomeController::class, 'validar'])->name('validando');
Route::get('/lista', [App\Http\Controllers\HomeController::class, 'lista'])->name('listando');
Route::post('gravar', [App\Http\Controllers\HomeController::class, 'gravar'])->name('gravando');
Route::get('/remover', [App\Http\Controllers\HomeController::class, 'remover'])->name('removendo');
Route::post('analise', [App\Http\Controllers\HomeController::class, 'analise'])->name('analisando');


#Route::get('/admin',[App\Http\Controllers\AuthController::class, 'dashboard'])->name('admin');
#Route::get('/admin/login',[App\Http\Controllers\AuthController::class, 'veFormLogin'])->name('admin.login');
