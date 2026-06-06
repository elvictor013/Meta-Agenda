@extends('layouts.app')
@include('partials.sidebar-coord')
@section('title','Alocações')
@section('page-title','Alocações')
@section('page-subtitle','Grade de aulas por dia da semana')

@section('header-actions')
<button onclick="openModal('modalCriar')" class="flex items-center gap-2 bg-brand-900 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-brand-800">
    <span class="ms">add</span> Nova Alocação
</button>
@endsection

@section('content')
<div class="pt-2">
@php
$diasOrdem = ['Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'];
$alocPorDia = $alocacoes->groupBy('dia_semana');
@endphp

@if($alocacoes->isEmpty())
<div class="bg-white rounded-2xl border border-slate-200 p-16 text-center shadow-sm">
    <span class="ms text-6xl text-slate-200 block mb-4">calendar_month</span>
    <p class="text-slate-500 font-semibold">Nenhuma alocação cadastrada.</p>
    <button onclick="openModal('modalCriar')" class="mt-4 inline-flex items-center gap-2 bg-brand-900 text-white px-4 py-2 rounded-xl text-sm font-semibold"><span class="ms">add</span> Criar primeira</button>
</div>
@else
<div class="space-y-6">
    @foreach($diasOrdem as $dia)
    @if(isset($alocPorDia[$dia]))
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-3 bg-brand-900 flex items-center gap-2">
            <span class="ms text-brand-300 ms-fill">today</span>
            <h3 class="font-bold text-white text-sm">{{ $dia }}</h3>
            <span class="ml-auto text-xs text-brand-300 font-semibold">{{ $alocPorDia[$dia]->count() }} aula(s)</span>
        </div>
        <div class="divide-y divide-slate-50">
            @foreach($alocPorDia[$dia]->sortBy('hora_inicio') as $aloc)
            <div class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50 transition-colors">
                {{-- Horário --}}
                <div class="flex-shrink-0 w-24 text-center">
                    <p class="text-sm font-bold text-brand-700">{{ substr($aloc->hora_inicio,0,5) }}</p>
                    <div class="w-px h-3 bg-slate-300 mx-auto"></div>
                    <p class="text-xs text-slate-400">{{ substr($aloc->hora_fim,0,5) }}</p>
                </div>
                {{-- Disciplina --}}
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-slate-800">{{ $aloc->disciplina->nome ?? '—' }}</p>
                    <div class="flex flex-wrap gap-1.5 mt-1">
                        @foreach($aloc->turmas as $t)
                        <span class="px-2 py-0.5 bg-brand-50 text-brand-700 text-xs font-semibold rounded-full">{{ $t->semestre . ' ' . $t->turno }}</span>
                        @endforeach
                    </div>
                </div>
                {{-- Professor --}}
                <div class="hidden md:flex items-center gap-2 text-sm text-slate-600 flex-shrink-0">
                    <span class="ms text-slate-400 text-base">person</span>
                    {{ $aloc->professor->nome ?? '—' }}
                </div>
                {{-- Sala --}}
                <div class="hidden lg:flex items-center gap-2 text-sm text-slate-600 flex-shrink-0">
                    <span class="ms text-slate-400 text-base">meeting_room</span>
                    {{ $aloc->sala->nome ?? '—' }}
                </div>
                @if($aloc->observacao)
                <div class="hidden xl:flex items-center gap-1 text-xs text-slate-400 max-w-32 truncate">
                    <span class="ms text-sm">info</span>{{ $aloc->observacao }}
                </div>
                @endif
                {{-- Ações --}}
                <div class="flex gap-1 flex-shrink-0">
                    <button onclick='openEdit(@json($aloc->load("turmas")))' class="p-1.5 rounded-lg text-slate-400 hover:text-brand-600 hover:bg-brand-50"><span class="ms">edit</span></button>
                    <button onclick="confirmDelete('{{ route('coord.alocacoes.delete',$aloc->id) }}')" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50"><span class="ms">delete</span></button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach
</div>
@endif
</div>
@endsection

@section('modals')
{{-- Modal Criar --}}
<div id="modalCriar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl modal-box max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 sticky top-0 bg-white">
            <h3 class="font-bold text-slate-800">Nova Alocação</h3>
            <button onclick="closeModal('modalCriar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" action="{{ route('coord.alocacoes.store') }}" class="px-6 py-4 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Disciplina</label>
                    <select name="disciplina_id" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Selecione...</option>
                        @foreach($disciplinas as $d)<option value="{{ $d->id }}">{{ $d->nome }}</option>@endforeach
                    </select></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Professor</label>
                    <select name="professor_id" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Selecione...</option>
                        @foreach($professores as $p)<option value="{{ $p->id }}">{{ $p->nome }}</option>@endforeach
                    </select></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Sala</label>
                    <select name="sala_id" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Selecione...</option>
                        @foreach($salas as $s)<option value="{{ $s->id }}">{{ $s->nome }}</option>@endforeach
                    </select></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Dia da Semana</label>
                    <select name="dia_semana" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Selecione...</option>
                        @foreach(['Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'] as $d)<option>{{ $d }}</option>@endforeach
                    </select></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Hora Início</label>
                    <input type="time" name="hora_inicio" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Hora Fim</label>
                    <input type="time" name="hora_fim" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            </div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Turmas <span class="text-slate-400">(pode selecionar várias)</span></label>
                <div class="border border-slate-200 rounded-xl p-3 max-h-40 overflow-y-auto space-y-1.5">
                    @foreach($turmas as $t)
                    <label class="flex items-center gap-2 cursor-pointer hover:bg-slate-50 rounded-lg px-2 py-1">
                        <input type="checkbox" name="turmas[]" value="{{ $t->id }}" class="rounded">
                        <span class="text-sm text-slate-700">{{ $t->semestre . ' ' . $t->turno }}</span>
                        <span class="text-xs text-slate-400">{{ $t->curso->nome ?? '' }}</span>
                    </label>
                    @endforeach
                </div></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Observação <span class="text-slate-400">(opcional)</span></label>
                <input type="text" name="observacao" placeholder="Ex: Revezamento quinzenal" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalCriar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Criar Alocação</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Editar --}}
<div id="modalEditar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl modal-box max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 sticky top-0 bg-white">
            <h3 class="font-bold text-slate-800">Editar Alocação</h3>
            <button onclick="closeModal('modalEditar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" id="formEditar" class="px-6 py-4 space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Disciplina</label>
                    <select name="disciplina_id" id="edit_disc" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        @foreach($disciplinas as $d)<option value="{{ $d->id }}">{{ $d->nome }}</option>@endforeach
                    </select></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Professor</label>
                    <select name="professor_id" id="edit_prof" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        @foreach($professores as $p)<option value="{{ $p->id }}">{{ $p->nome }}</option>@endforeach
                    </select></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Sala</label>
                    <select name="sala_id" id="edit_sala" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        @foreach($salas as $s)<option value="{{ $s->id }}">{{ $s->nome }}</option>@endforeach
                    </select></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Dia da Semana</label>
                    <select name="dia_semana" id="edit_dia" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        @foreach(['Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'] as $d)<option>{{ $d }}</option>@endforeach
                    </select></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Hora Início</label>
                    <input type="time" name="hora_inicio" id="edit_inicio" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Hora Fim</label>
                    <input type="time" name="hora_fim" id="edit_fim" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            </div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Turmas</label>
                <div class="border border-slate-200 rounded-xl p-3 max-h-40 overflow-y-auto space-y-1.5" id="edit_turmas_container">
                    @foreach($turmas as $t)
                    <label class="flex items-center gap-2 cursor-pointer hover:bg-slate-50 rounded-lg px-2 py-1">
                        <input type="checkbox" name="turmas[]" value="{{ $t->id }}" class="turma-check rounded">
                        <span class="text-sm text-slate-700">{{ $t->semestre . ' ' . $t->turno }}</span>
                        <span class="text-xs text-slate-400">{{ $t->curso->nome ?? '' }}</span>
                    </label>
                    @endforeach
                </div></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Observação</label>
                <input type="text" name="observacao" id="edit_obs" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalEditar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div id="modalDelete" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm modal-box p-6 text-center">
        <span class="ms ms-fill text-red-400 text-5xl mb-3 block">delete_forever</span>
        <p class="text-sm text-slate-500 mb-6">Excluir esta alocação?</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modalDelete')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
            <form id="formDelete" method="POST" class="flex-1">@csrf @method('DELETE')
                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Excluir</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openModal(id){ document.getElementById(id).classList.remove('hidden'); }
function closeModal(id){ document.getElementById(id).classList.add('hidden'); }
function openEdit(a){
    document.getElementById('formEditar').action = `/coordenador/alocacoes/${a.id}`;
    document.getElementById('edit_disc').value    = a.disciplina_id;
    document.getElementById('edit_prof').value    = a.professor_id;
    document.getElementById('edit_sala').value    = a.sala_id;
    document.getElementById('edit_dia').value     = a.dia_semana;
    document.getElementById('edit_inicio').value  = a.hora_inicio;
    document.getElementById('edit_fim').value     = a.hora_fim;
    document.getElementById('edit_obs').value     = a.observacao || '';
    // turmas
    const turmasIds = (a.turmas || []).map(t => String(t.id));
    document.querySelectorAll('.turma-check').forEach(cb => {
        cb.checked = turmasIds.includes(cb.value);
    });
    openModal('modalEditar');
}
function confirmDelete(url){ document.getElementById('formDelete').action = url; openModal('modalDelete'); }
document.querySelectorAll('.modal-overlay').forEach(m => m.addEventListener('click', function(e){ if(e.target===this) this.classList.add('hidden'); }));
</script>
@endsection
