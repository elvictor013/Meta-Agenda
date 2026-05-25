<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coordenador;
use App\Models\Curso;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    // ======================
    // DASHBOARD
    // ======================
    public function index()
    {
        $cursos = Curso::all();
        $coordenadores = Coordenador::with('cursos')->get();

        return view('admin.dashboard', compact('cursos', 'coordenadores'));
    }

    // ======================
    // CURSOS
    // ======================
    public function storeCurso(Request $request)
    {
        Curso::create([
            'nome' => $request->nome
        ]);

        return back()->with('success', 'Curso criado');
    }

    public function deleteCurso($id)
    {
        Curso::findOrFail($id)->delete();

        return back()->with('success', 'Curso removido');
    }

    public function updateCurso(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);

        $curso->update([
            'nome' => $request->nome
        ]);

        return back()->with('success', 'Curso atualizado');
    }

    // ======================
    // COORDENADORES
    // ======================
    public function storeCoordenador(Request $request)
    {
        $coord = Coordenador::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'password' => bcrypt($request->password),
            'ativo' => true,
        ]);

        $coord->cursos()->sync($request->cursos);

        return back()->with('success', 'Coordenador criado');
    }


 public function updateCoordenador(Request $request, $id)
{
    $coord = Coordenador::findOrFail($id);

    $coord->update([
        'nome' => $request->nome,
        'cpf' => $request->cpf,
    ]);

    //  ATUALIZA CURSOS
    $coord->cursos()->sync($request->cursos ?? []);

    return back()->with('success', 'Coordenador atualizado com sucesso');
}

    public function toggleCoordenador($id)
    {
        $coord = Coordenador::findOrFail($id);

        $coord->ativo = !$coord->ativo;
        $coord->save();

        return back()->with('success', 'Status atualizado');
    }
}
