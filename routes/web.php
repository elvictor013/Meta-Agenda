<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfessorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'));

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO - COORDENADOR / ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('login')->group(function () {
    Route::get('/coordenador', [LoginController::class, 'index'])->name('login.coordenador');
    Route::post('/coordenador', [LoginController::class, 'loginProcess'])->name('login.process');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ÁREA PROTEGIDA - COORDENADOR & ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth:coordenador')->group(function () {

    // Redirect inteligente do dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    /*
    |------------------------------------------------------------------
    | COORDENAÇÃO
    |------------------------------------------------------------------
    */
    Route::prefix('coordenador')->name('coord.')->group(function () {
        Route::get('/dashboard',       [CoordenadorController::class, 'dashboard'])->name('dashboard');

        // Turmas
        Route::get('/turmas',          [CoordenadorController::class, 'turmas'])->name('turmas');
        Route::post('/turmas',         [CoordenadorController::class, 'storeTurma'])->name('turmas.store');
        Route::put('/turmas/{id}',     [CoordenadorController::class, 'updateTurma'])->name('turmas.update');
        Route::delete('/turmas/{id}',  [CoordenadorController::class, 'deleteTurma'])->name('turmas.delete');

        // Professores
        Route::get('/professores',           [CoordenadorController::class, 'professores'])->name('professores');
        Route::post('/professores',          [CoordenadorController::class, 'storeProfessor'])->name('professores.store');
        Route::put('/professores/{id}',      [CoordenadorController::class, 'updateProfessor'])->name('professores.update');
        Route::delete('/professores/{id}',   [CoordenadorController::class, 'deleteProfessor'])->name('professores.delete');

        // Alunos
        Route::get('/alunos',          [CoordenadorController::class, 'alunos'])->name('alunos');
        Route::post('/alunos',         [CoordenadorController::class, 'storeAluno'])->name('alunos.store');
        Route::put('/alunos/{id}',     [CoordenadorController::class, 'updateAluno'])->name('alunos.update');
        Route::delete('/alunos/{id}',  [CoordenadorController::class, 'deleteAluno'])->name('alunos.delete');

        // Disciplinas
        Route::get('/disciplinas',           [CoordenadorController::class, 'disciplinas'])->name('disciplinas');
        Route::post('/disciplinas',          [CoordenadorController::class, 'storeDisciplina'])->name('disciplinas.store');
        Route::put('/disciplinas/{id}',      [CoordenadorController::class, 'updateDisciplina'])->name('disciplinas.update');
        Route::delete('/disciplinas/{id}',   [CoordenadorController::class, 'deleteDisciplina'])->name('disciplinas.delete');

        // Salas
        Route::get('/salas',           [CoordenadorController::class, 'salas'])->name('salas');
        Route::post('/salas',          [CoordenadorController::class, 'storeSala'])->name('salas.store');
        Route::put('/salas/{id}',      [CoordenadorController::class, 'updateSala'])->name('salas.update');
        Route::delete('/salas/{id}',   [CoordenadorController::class, 'deleteSala'])->name('salas.delete');

        // Alocações
        Route::get('/alocacoes',           [CoordenadorController::class, 'alocacoes'])->name('alocacoes');
        Route::post('/alocacoes',          [CoordenadorController::class, 'storeAlocacao'])->name('alocacoes.store');
        Route::put('/alocacoes/{id}',      [CoordenadorController::class, 'updateAlocacao'])->name('alocacoes.update');
        Route::delete('/alocacoes/{id}',   [CoordenadorController::class, 'deleteAlocacao'])->name('alocacoes.delete');

        // Notificações
        Route::get('/notificacoes',           [CoordenadorController::class, 'notificacoes'])->name('notificacoes');
        Route::post('/notificacoes',          [CoordenadorController::class, 'storeNotificacao'])->name('notificacoes.store');
        Route::delete('/notificacoes/{id}',   [CoordenadorController::class, 'deleteNotificacao'])->name('notificacoes.delete');
    });

    /*
    |------------------------------------------------------------------
    | ADMIN
    |------------------------------------------------------------------
    */
    Route::middleware('admin.only')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Cursos
        Route::post('/curso',           [AdminController::class, 'storeCurso'])->name('curso.store');
        Route::put('/curso/{id}',       [AdminController::class, 'updateCurso'])->name('curso.update');
        Route::delete('/curso/{id}',    [AdminController::class, 'deleteCurso'])->name('curso.delete');

        // Coordenadores
        Route::post('/coordenador',           [AdminController::class, 'storeCoordenador'])->name('coord.store');
        Route::put('/coordenador/{id}',       [AdminController::class, 'updateCoordenador'])->name('coord.update');
        Route::post('/coordenador/{id}/toggle', [AdminController::class, 'toggleCoordenador'])->name('coord.toggle');

        // Perfil
        Route::get('/perfil',           [ProfileAdminController::class, 'edit'])->name('perfil');
        Route::put('/perfil/{perfil}',  [ProfileAdminController::class, 'update'])->name('update');
    });
});

/*
|--------------------------------------------------------------------------
| PROFESSOR (sem login, acesso por CPF + sessão)
|--------------------------------------------------------------------------
*/
Route::prefix('professor')->name('professor.')->group(function () {
    Route::get('/',           [ProfessorController::class, 'index'])->name('consulta');
    Route::post('/buscar',    [ProfessorController::class, 'buscar'])->name('buscar');
    Route::get('/dashboard',  [ProfessorController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout',    [ProfessorController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ALUNO (sem login, acesso por matrícula + sessão)
|--------------------------------------------------------------------------
*/
Route::prefix('aluno')->name('aluno.')->group(function () {
    Route::get('/',           [AlunoController::class, 'index'])->name('consulta');
    Route::post('/buscar',    [AlunoController::class, 'buscar'])->name('buscar');
    Route::get('/dashboard',  [AlunoController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout',    [AlunoController::class, 'logout'])->name('logout');
});
