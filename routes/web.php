<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\AlunosController;
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
    return view('login');
});

Route::get('/welcome', function() {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'login']);

Route::get('/home', [HomeController::class, 'index']);

Route::group([ 'prefix' => '/usuarios'], function() {
    Route::get('/', [UserController::class, 'index'])->name('usuarios');
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/store', [UserController::class, 'store']);
    Route::get('/{id}/show', [UserController::class, 'show']);
    Route::post('/{id}/update', [UserController::class, 'update']);
    Route::get('/{id}/delete',  [UserController::class, 'destroy']);
});

Route::group([ 'prefix' => '/professores'], function() {
    Route::get('/', [ProfessoresController::class, 'index'])->name('professores');
    Route::get('/create', [ProfessoresController::class, 'create']);
    Route::post('/store', [ProfessoresController::class, 'store']);
    Route::get('/{id}/show', [ProfessoresController::class, 'show']);
    Route::post('/{id}/update', [ProfessoresController::class, 'update']);
    Route::get('/{id}/delete',  [ProfessoresController::class, 'destroy']);
});

Route::group([ 'prefix' => '/alunos'], function() {
    Route::get('/', [AlunosController::class, 'index'])->name('alunos');
    Route::get('/create', [AlunosController::class, 'create']);
    Route::post('/store', [AlunosController::class, 'store']);
    Route::get('/{id}/show', [AlunosController::class, 'show']);
    Route::post('/{id}/update', [AlunosController::class, 'update']);
    Route::get('/{id}/delete',  [AlunosController::class, 'destroy']);
});