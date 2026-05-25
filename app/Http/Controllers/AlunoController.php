<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
use App\Models\Aluno;
use App\Models\Notificacao;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{
    public function index()
    {
        return view('aluno.index');
    }

    public function buscar(AlunoRequest $request)
    {
        $aluno = Aluno::where('matricula', $request->matricula)->first();

        if (!$aluno) {
            return back()->with('error', 'Matrícula não encontrada.');
        }

        Session::put('aluno_id', $aluno->id);
        return redirect()->route('aluno.dashboard');
    }

    public function dashboard()
    {
        $alunoId = Session::get('aluno_id');

        if (!$alunoId) {
            return redirect()->route('aluno.consulta')->with('error', 'Informe sua matrícula.');
        }

        $aluno = Aluno::with([
            'turma.curso',
            'turma.alocacoes.disciplina',
            'turma.alocacoes.professor',
            'turma.alocacoes.sala',
            'turma.alocacoes.turmas',
        ])->find($alunoId);

        if (!$aluno || !$aluno->turma) {
            Session::forget('aluno_id');
            return redirect()->route('aluno.consulta')->with('error', 'Sessão inválida.');
        }

        // Alocações da turma do aluno, já carregadas
        $alocacoes = $aluno->turma->alocacoes;

        // Detectar próxima aula (hoje, a partir de agora)
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

        $notificacoes = Notificacao::where('turma_id', $aluno->turma_id)->latest()->get();

        return view('aluno.dashboard', compact('aluno', 'alocacoes', 'notificacoes', 'proxima'));
    }

    public function logout()
    {
        Session::forget('aluno_id');
        return redirect()->route('aluno.consulta');
    }
}
