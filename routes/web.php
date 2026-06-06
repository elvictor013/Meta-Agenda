<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfessorController;
use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/', fn() => view('welcome'));

// Auth Coordenador / Admin
Route::prefix('login')->group(function () {
    Route::get('/coordenador',  [LoginController::class, 'index'])->name('login.coordenador');
    Route::post('/coordenador', [LoginController::class, 'loginProcess'])->name('login.process');
    Route::post('/logout',      [LoginController::class, 'destroy'])->name('logout');
});

// Área protegida
Route::middleware('auth:coordenador')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Coordenação
    Route::prefix('coordenador')->name('coord.')->group(function () {
        Route::get('/dashboard', [CoordenadorController::class, 'dashboard'])->name('dashboard');

        Route::get('/turmas',         [CoordenadorController::class, 'turmas'])->name('turmas');
        Route::post('/turmas',        [CoordenadorController::class, 'storeTurma'])->name('turmas.store');
        Route::put('/turmas/{id}',    [CoordenadorController::class, 'updateTurma'])->name('turmas.update');
        Route::delete('/turmas/{id}', [CoordenadorController::class, 'deleteTurma'])->name('turmas.delete');

        Route::get('/professores',         [CoordenadorController::class, 'professores'])->name('professores');
        Route::post('/professores',        [CoordenadorController::class, 'storeProfessor'])->name('professores.store');
        Route::put('/professores/{id}',    [CoordenadorController::class, 'updateProfessor'])->name('professores.update');
        Route::delete('/professores/{id}', [CoordenadorController::class, 'deleteProfessor'])->name('professores.delete');

        Route::get('/disciplinas',         [CoordenadorController::class, 'disciplinas'])->name('disciplinas');
        Route::post('/disciplinas',        [CoordenadorController::class, 'storeDisciplina'])->name('disciplinas.store');
        Route::put('/disciplinas/{id}',    [CoordenadorController::class, 'updateDisciplina'])->name('disciplinas.update');
        Route::delete('/disciplinas/{id}', [CoordenadorController::class, 'deleteDisciplina'])->name('disciplinas.delete');

        Route::get('/salas',         [CoordenadorController::class, 'salas'])->name('salas');
        Route::post('/salas',        [CoordenadorController::class, 'storeSala'])->name('salas.store');
        Route::put('/salas/{id}',    [CoordenadorController::class, 'updateSala'])->name('salas.update');
        Route::delete('/salas/{id}', [CoordenadorController::class, 'deleteSala'])->name('salas.delete');

        Route::get('/alocacoes',         [CoordenadorController::class, 'alocacoes'])->name('alocacoes');
        Route::post('/alocacoes',        [CoordenadorController::class, 'storeAlocacao'])->name('alocacoes.store');
        Route::put('/alocacoes/{id}',    [CoordenadorController::class, 'updateAlocacao'])->name('alocacoes.update');
        Route::delete('/alocacoes/{id}', [CoordenadorController::class, 'deleteAlocacao'])->name('alocacoes.delete');

        Route::get('/notificacoes',         [CoordenadorController::class, 'notificacoes'])->name('notificacoes');
        Route::post('/notificacoes',        [CoordenadorController::class, 'storeNotificacao'])->name('notificacoes.store');
        Route::delete('/notificacoes/{id}', [CoordenadorController::class, 'deleteNotificacao'])->name('notificacoes.delete');
    });

    // Admin
    Route::middleware('admin.only')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard',              [AdminController::class, 'index'])->name('dashboard');
        Route::post('/curso',                 [AdminController::class, 'storeCurso'])->name('curso.store');
        Route::put('/curso/{id}',             [AdminController::class, 'updateCurso'])->name('curso.update');
        Route::delete('/curso/{id}',          [AdminController::class, 'deleteCurso'])->name('curso.delete');
        Route::post('/coordenador',           [AdminController::class, 'storeCoordenador'])->name('coord.store');
        Route::put('/coordenador/{id}',       [AdminController::class, 'updateCoordenador'])->name('coord.update');
        Route::post('/coordenador/{id}/toggle', [AdminController::class, 'toggleCoordenador'])->name('coord.toggle');
        Route::get('/perfil',                 [ProfileAdminController::class, 'edit'])->name('perfil');
        Route::put('/perfil/{perfil}',        [ProfileAdminController::class, 'update'])->name('update');
    });
});

// Professor (sessão por CPF)
Route::prefix('professor')->name('professor.')->group(function () {
    Route::get('/',          [ProfessorController::class, 'index'])->name('consulta');
    Route::post('/buscar',   [ProfessorController::class, 'buscar'])->name('buscar');
    Route::get('/dashboard', [ProfessorController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout',   [ProfessorController::class, 'logout'])->name('logout');
});

// Aluno (sem login — seleção por curso + semestre + turno)
Route::prefix('aluno')->name('aluno.')->group(function () {
    Route::get('/',          [AlunoController::class, 'index'])->name('consulta');
    Route::get('/turmas',    [AlunoController::class, 'getTurmas'])->name('turmas');
    Route::get('/turnos',    [AlunoController::class, 'getTurnos'])->name('turnos');
    Route::post('/buscar',   [AlunoController::class, 'buscar'])->name('buscar');
    Route::get('/dashboard', [AlunoController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout',   [AlunoController::class, 'logout'])->name('logout');
});
