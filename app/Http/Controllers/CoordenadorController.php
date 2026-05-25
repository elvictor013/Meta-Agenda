<?php

namespace App\Http\Controllers;

use App\Models\Alocacao;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Notificacao;
use App\Models\Professor;
use App\Models\Sala;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoordenadorController extends Controller
{
    private function coordenador()
    {
        return Auth::guard('coordenador')->user();
    }

    private function cursosIds()
    {
        return $this->coordenador()->cursos->pluck('id');
    }

    // =====================
    // DASHBOARD
    // =====================
    public function dashboard()
    {
        $coordenador = $this->coordenador()->load('cursos');
        $cursosIds   = $this->cursosIds();

        $totalAlocacoes  = Alocacao::whereHas('turmas', fn($q) => $q->whereIn('curso_id', $cursosIds))->count();
        $totalTurmas     = Turma::whereIn('curso_id', $cursosIds)->count();
        $totalProfessores = Professor::count();
        $totalAlunos     = Aluno::whereHas('turma', fn($q) => $q->whereIn('curso_id', $cursosIds))->count();

        $alocacoesRecentes = Alocacao::with(['disciplina', 'professor', 'sala', 'turmas'])
            ->whereHas('turmas', fn($q) => $q->whereIn('curso_id', $cursosIds))
            ->latest()->limit(5)->get();

        $notificacoesRecentes = Notificacao::with('turma')
            ->whereHas('turma', fn($q) => $q->whereIn('curso_id', $cursosIds))
            ->latest()->limit(5)->get();

        return view('coordenador.dashboard', compact(
            'coordenador', 'totalAlocacoes', 'totalTurmas',
            'totalProfessores', 'totalAlunos',
            'alocacoesRecentes', 'notificacoesRecentes'
        ));
    }

    // =====================
    // TURMAS
    // =====================
    public function turmas()
    {
        $cursosIds = $this->cursosIds();
        $turmas    = Turma::with('curso')->whereIn('curso_id', $cursosIds)->get();
        $cursos    = $this->coordenador()->cursos;
        return view('coordenador.turmas', compact('turmas', 'cursos'));
    }

    public function storeTurma(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:100',
            'semestre' => 'required|string|max:50',
            'turno'    => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        // Segurança: só pode criar turma no curso dele
        if (!$this->cursosIds()->contains($request->curso_id)) {
            return back()->with('error', 'Sem permissão para este curso.');
        }

        Turma::create($request->only('nome', 'semestre', 'turno', 'curso_id'));
        return back()->with('success', 'Turma criada com sucesso!');
    }

    public function updateTurma(Request $request, $id)
    {
        $turma = Turma::whereIn('curso_id', $this->cursosIds())->findOrFail($id);
        $turma->update($request->only('nome', 'semestre', 'turno', 'curso_id'));
        return back()->with('success', 'Turma atualizada!');
    }

    public function deleteTurma($id)
    {
        $turma = Turma::whereIn('curso_id', $this->cursosIds())->findOrFail($id);
        $turma->delete();
        return back()->with('success', 'Turma removida!');
    }

    // =====================
    // PROFESSORES
    // =====================
    public function professores()
    {
        $professores = Professor::withCount('alocacoes')->get();
        return view('coordenador.professores', compact('professores'));
    }

    public function storeProfessor(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:150',
            'cpf'  => 'required|string|size:11|unique:professores,cpf',
        ]);
        Professor::create($request->only('nome', 'cpf'));
        return back()->with('success', 'Professor cadastrado!');
    }

    public function updateProfessor(Request $request, $id)
    {
        $prof = Professor::findOrFail($id);
        $request->validate([
            'nome' => 'required|string|max:150',
            'cpf'  => 'required|string|size:11|unique:professores,cpf,' . $id,
        ]);
        $prof->update($request->only('nome', 'cpf'));
        return back()->with('success', 'Professor atualizado!');
    }

    public function deleteProfessor($id)
    {
        Professor::findOrFail($id)->delete();
        return back()->with('success', 'Professor removido!');
    }

    // =====================
    // ALUNOS
    // =====================
    public function alunos()
    {
        $cursosIds = $this->cursosIds();
        $alunos    = Aluno::with('turma.curso')->whereHas('turma', fn($q) => $q->whereIn('curso_id', $cursosIds))->get();
        $turmas    = Turma::with('curso')->whereIn('curso_id', $cursosIds)->get();
        return view('coordenador.alunos', compact('alunos', 'turmas'));
    }

    public function storeAluno(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:150',
            'matricula' => 'required|string|unique:alunos,matricula',
            'turma_id'  => 'required|exists:turmas,id',
        ]);
        Aluno::create($request->only('nome', 'matricula', 'turma_id'));
        return back()->with('success', 'Aluno cadastrado!');
    }

    public function updateAluno(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);
        $request->validate([
            'nome'      => 'required|string|max:150',
            'matricula' => 'required|string|unique:alunos,matricula,' . $id,
            'turma_id'  => 'required|exists:turmas,id',
        ]);
        $aluno->update($request->only('nome', 'matricula', 'turma_id'));
        return back()->with('success', 'Aluno atualizado!');
    }

    public function deleteAluno($id)
    {
        Aluno::findOrFail($id)->delete();
        return back()->with('success', 'Aluno removido!');
    }

    // =====================
    // DISCIPLINAS
    // =====================
    public function disciplinas()
    {
        $cursosIds  = $this->cursosIds();
        $disciplinas = Disciplina::with('curso')->whereIn('curso_id', $cursosIds)->get();
        $cursos     = $this->coordenador()->cursos;
        return view('coordenador.disciplinas', compact('disciplinas', 'cursos'));
    }

    public function storeDisciplina(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:150',
            'curso_id' => 'required|exists:cursos,id',
        ]);
        if (!$this->cursosIds()->contains($request->curso_id)) {
            return back()->with('error', 'Sem permissão para este curso.');
        }
        Disciplina::create($request->only('nome', 'curso_id'));
        return back()->with('success', 'Disciplina criada!');
    }

    public function updateDisciplina(Request $request, $id)
    {
        $disc = Disciplina::whereIn('curso_id', $this->cursosIds())->findOrFail($id);
        $disc->update($request->only('nome', 'curso_id'));
        return back()->with('success', 'Disciplina atualizada!');
    }

    public function deleteDisciplina($id)
    {
        Disciplina::whereIn('curso_id', $this->cursosIds())->findOrFail($id)->delete();
        return back()->with('success', 'Disciplina removida!');
    }

    // =====================
    // SALAS
    // =====================
    public function salas()
    {
        $salas = Sala::all();
        return view('coordenador.salas', compact('salas'));
    }

    public function storeSala(Request $request)
    {
        $request->validate(['nome' => 'required|string|max:100']);
        Sala::create($request->only('nome', 'capacidade', 'tipo'));
        return back()->with('success', 'Sala criada!');
    }

    public function updateSala(Request $request, $id)
    {
        Sala::findOrFail($id)->update($request->only('nome', 'capacidade', 'tipo'));
        return back()->with('success', 'Sala atualizada!');
    }

    public function deleteSala($id)
    {
        Sala::findOrFail($id)->delete();
        return back()->with('success', 'Sala removida!');
    }

    // =====================
    // ALOCAÇÕES
    // =====================
    public function alocacoes()
    {
        $cursosIds   = $this->cursosIds();
        $alocacoes   = Alocacao::with(['disciplina', 'professor', 'sala', 'turmas.curso'])
            ->whereHas('turmas', fn($q) => $q->whereIn('curso_id', $cursosIds))
            ->get();
        $disciplinas = Disciplina::whereIn('curso_id', $cursosIds)->get();
        $professores = Professor::orderBy('nome')->get();
        $salas       = Sala::orderBy('nome')->get();
        $turmas      = Turma::with('curso')->whereIn('curso_id', $cursosIds)->get();
        return view('coordenador.alocacoes', compact('alocacoes', 'disciplinas', 'professores', 'salas', 'turmas'));
    }

    public function storeAlocacao(Request $request)
    {
        $request->validate([
            'disciplina_id' => 'required|exists:disciplinas,id',
            'professor_id'  => 'required|exists:professores,id',
            'sala_id'       => 'required|exists:salas,id',
            'dia_semana'    => 'required|string',
            'hora_inicio'   => 'required',
            'hora_fim'      => 'required|after:hora_inicio',
            'turmas'        => 'required|array|min:1',
        ]);

        // Verificar conflitos
        $conflito = $this->verificarConflito(
            $request->professor_id,
            $request->sala_id,
            $request->turmas,
            $request->dia_semana,
            $request->hora_inicio,
            $request->hora_fim
        );

        if ($conflito) {
            return back()->with('error', $conflito)->withInput();
        }

        $alocacao = Alocacao::create($request->only(
            'disciplina_id', 'professor_id', 'sala_id',
            'dia_semana', 'hora_inicio', 'hora_fim', 'observacao'
        ));
        $alocacao->turmas()->sync($request->turmas);

        return back()->with('success', 'Alocação criada com sucesso!');
    }

    public function updateAlocacao(Request $request, $id)
    {
        $alocacao = Alocacao::findOrFail($id);

        $conflito = $this->verificarConflito(
            $request->professor_id,
            $request->sala_id,
            $request->turmas ?? [],
            $request->dia_semana,
            $request->hora_inicio,
            $request->hora_fim,
            $id
        );

        if ($conflito) {
            return back()->with('error', $conflito);
        }

        $alocacao->update($request->only(
            'disciplina_id', 'professor_id', 'sala_id',
            'dia_semana', 'hora_inicio', 'hora_fim', 'observacao'
        ));
        $alocacao->turmas()->sync($request->turmas ?? []);

        return back()->with('success', 'Alocação atualizada!');
    }

    public function deleteAlocacao($id)
    {
        $alocacao = Alocacao::findOrFail($id);
        $alocacao->turmas()->detach();
        $alocacao->delete();
        return back()->with('success', 'Alocação removida!');
    }

    // =====================
    // NOTIFICAÇÕES
    // =====================
    public function notificacoes()
    {
        $cursosIds     = $this->cursosIds();
        $notificacoes  = Notificacao::with('turma')
            ->whereHas('turma', fn($q) => $q->whereIn('curso_id', $cursosIds))
            ->latest()->get();
        $turmas = Turma::with('curso')->whereIn('curso_id', $cursosIds)->get();
        return view('coordenador.notificacoes', compact('notificacoes', 'turmas'));
    }

    public function storeNotificacao(Request $request)
    {
        $request->validate([
            'turma_id' => 'required|exists:turmas,id',
            'titulo'   => 'required|string|max:200',
            'mensagem' => 'required|string',
        ]);
        Notificacao::create($request->only('turma_id', 'titulo', 'mensagem', 'tipo'));
        return back()->with('success', 'Notificação enviada!');
    }

    public function deleteNotificacao($id)
    {
        Notificacao::findOrFail($id)->delete();
        return back()->with('success', 'Notificação removida!');
    }

    // =====================
    // VERIFICAÇÃO DE CONFLITOS
    // =====================
    private function verificarConflito($professorId, $salaId, $turmasIds, $dia, $inicio, $fim, $ignorarId = null)
    {
        $query = Alocacao::where('dia_semana', $dia)
            ->where(function ($q) use ($inicio, $fim) {
                $q->where(fn($q2) => $q2->where('hora_inicio', '<', $fim)->where('hora_fim', '>', $inicio));
            });

        if ($ignorarId) {
            $query->where('id', '!=', $ignorarId);
        }

        // Conflito de professor
        if ($query->clone()->where('professor_id', $professorId)->exists()) {
            return 'Conflito: este professor já tem aula neste horário.';
        }

        // Conflito de sala
        if ($query->clone()->where('sala_id', $salaId)->exists()) {
            return 'Conflito: esta sala já está ocupada neste horário.';
        }

        // Conflito de turma
        if (!empty($turmasIds)) {
            if ($query->clone()->whereHas('turmas', fn($q) => $q->whereIn('turmas.id', $turmasIds))->exists()) {
                return 'Conflito: uma ou mais turmas já têm aula neste horário.';
            }
        }

        return null;
    }
}
