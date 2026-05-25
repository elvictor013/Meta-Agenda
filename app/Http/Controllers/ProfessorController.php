<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfessorController extends Controller
{
    public function index()
    {
        return view('professor.index');
    }

    public function buscar(Request $request)
    {
        $request->validate(['cpf' => 'required|string']);

        $cpf = preg_replace('/\D/', '', $request->cpf);

        $professor = Professor::where('cpf', $cpf)->first();

        if (!$professor) {
            return back()->with('error', 'CPF não encontrado. Verifique e tente novamente.');
        }

        Session::put('professor_id', $professor->id);
        return redirect()->route('professor.dashboard');
    }

    public function dashboard()
    {
        $professorId = Session::get('professor_id');

        if (!$professorId) {
            return redirect()->route('professor.consulta')->with('error', 'Informe seu CPF.');
        }

        $professor = Professor::with([
            'alocacoes.disciplina',
            'alocacoes.sala',
            'alocacoes.turmas',
        ])->find($professorId);

        if (!$professor) {
            Session::forget('professor_id');
            return redirect()->route('professor.consulta')->with('error', 'Sessão inválida.');
        }

        $alocacoes = $professor->alocacoes;

        return view('professor.dashboard', compact('professor', 'alocacoes'));
    }

    public function logout()
    {
        Session::forget('professor_id');
        return redirect()->route('professor.consulta');
    }
}
