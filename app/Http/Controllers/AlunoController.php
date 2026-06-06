<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Notificacao;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{
    public function index()
    {
        $cursos = Curso::orderBy('nome')->get();
        return view('aluno.index', compact('cursos'));
    }

    public function getTurmas(Request $request)
    {
        $turmas = Turma::where('curso_id', $request->curso_id)
            ->select('semestre')
            ->distinct()
            ->orderBy('semestre')
            ->get();
        return response()->json($turmas);
    }

    public function getTurnos(Request $request)
    {
        $turnos = Turma::where('curso_id', $request->curso_id)
            ->where('semestre', $request->semestre)
            ->select('turno')
            ->distinct()
            ->orderBy('turno')
            ->get();
        return response()->json($turnos);
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'semestre' => 'required|string',
            'turno'    => 'required|string',
        ]);

        $turma = Turma::where('curso_id', $request->curso_id)
            ->where('semestre', $request->semestre)
            ->where('turno', $request->turno)
            ->first();

        if (!$turma) {
            return back()->with('error', 'Nenhuma turma encontrada com essas informações.')->withInput();
        }

        Session::put('turma_id', $turma->id);
        return redirect()->route('aluno.dashboard');
    }

    public function dashboard()
    {
        $turmaId = Session::get('turma_id');

        if (!$turmaId) {
            return redirect()->route('aluno.consulta')->with('error', 'Selecione seu curso, turma e turno.');
        }

        $turma = Turma::with([
            'curso',
            'alocacoes.disciplina',
            'alocacoes.professor',
            'alocacoes.sala',
            'alocacoes.turmas',
        ])->find($turmaId);

        if (!$turma) {
            Session::forget('turma_id');
            return redirect()->route('aluno.consulta')->with('error', 'Turma não encontrada.');
        }

        $alocacoes = $turma->alocacoes;

        $diasMap = [
            0 => 'Domingo', 1 => 'Segunda', 2 => 'Terça',
            3 => 'Quarta',  4 => 'Quinta',  5 => 'Sexta', 6 => 'Sábado',
        ];
        $diaHoje = $diasMap[now()->dayOfWeek];
        $agoraStr = now()->format('H:i');

        $proxima = $alocacoes
            ->where('dia_semana', $diaHoje)
            ->filter(fn($a) => substr($a->hora_inicio, 0, 5) >= $agoraStr)
            ->sortBy('hora_inicio')
            ->first();

        $notificacoes = Notificacao::where('turma_id', $turmaId)->latest()->get();

        return view('aluno.dashboard', compact('turma', 'alocacoes', 'notificacoes', 'proxima'));
    }

    public function logout()
    {
        Session::forget('turma_id');
        return redirect()->route('aluno.consulta');
    }
}
