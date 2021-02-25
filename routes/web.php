<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\TurmasController;
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

Route::group([ 'prefix' => '/disciplinas'], function() {
    Route::get('/', [DisciplinasController::class, 'index'])->name('disciplinas');
    Route::get('/create', [DisciplinasController::class, 'create']);
    Route::post('/store', [DisciplinasController::class, 'store']);
    Route::get('/{id}/show', [DisciplinasController::class, 'show']);
    Route::post('/{id}/update', [DisciplinasController::class, 'update']);
    Route::get('/{id}/delete',  [DisciplinasController::class, 'destroy']);
});

Route::group([ 'prefix' => '/turmas'], function() {
    Route::get('/', [TurmasController::class, 'index'])->name('turmas');
    Route::get('/create', [TurmasController::class, 'create']);
    Route::post('/store', [TurmasController::class, 'store']);
    Route::get('/{id}/show', [TurmasController::class, 'show'])->name('turmas_show');
    Route::post('/{id}/update', [TurmasController::class, 'update']);
    Route::get('/{id}/delete',  [TurmasController::class, 'destroy']);
    Route::get('/{id}/alunos', [TurmasController::class, 'alunos']);
    Route::get('/searchAlunos', [TurmasController::class, 'searchAlunos'])->name('search_alunos');
    Route::get('/addAlunos', [TurmasController::class, 'addAlunos'])->name('add_alunos');
});