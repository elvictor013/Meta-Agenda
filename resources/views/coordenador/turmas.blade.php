@extends('layouts.app')
@include('partials.sidebar-coord')
@section('title','Turmas')
@section('page-title','Turmas')
@section('page-subtitle','Gerencie as turmas dos seus cursos')

@section('header-actions')
<button onclick="openModal('modalCriar')" class="flex items-center gap-2 bg-brand-900 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-brand-800 transition-colors">
    <span class="ms">add</span> Nova Turma
</button>
@endsection

@section('content')
<div class="pt-2">
    @if($turmas->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-200 p-16 text-center shadow-sm">
        <span class="ms text-6xl text-slate-200 block mb-4">groups</span>
        <p class="text-slate-500 font-semibold">Nenhuma turma cadastrada.</p>
        <button onclick="openModal('modalCriar')" class="mt-4 inline-flex items-center gap-2 bg-brand-900 text-white px-4 py-2 rounded-xl text-sm font-semibold">
            <span class="ms">add</span> Criar primeira turma
        </button>
    </div>
    @else
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="text-left px-6 py-3 font-semibold text-slate-600">Turma</th>
                    <th class="text-left px-6 py-3 font-semibold text-slate-600">Curso</th>
                    <th class="text-left px-6 py-3 font-semibold text-slate-600">Semestre</th>
                    <th class="text-left px-6 py-3 font-semibold text-slate-600">Turno</th>
                    <th class="text-right px-6 py-3 font-semibold text-slate-600">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($turmas as $turma)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $turma->nome }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $turma->curso->nome ?? '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 bg-brand-50 text-brand-700 text-xs font-semibold rounded-full">{{ $turma->semestre }}</span>
                    </td>
                    <td class="px-6 py-4 text-slate-600">{{ $turma->turno }}</td>
                    <td class="px-6 py-4 text-right">
                        <button onclick='openEdit(@json($turma))' class="p-1.5 rounded-lg text-slate-400 hover:text-brand-600 hover:bg-brand-50 transition-colors"><span class="ms">edit</span></button>
                        <button onclick="confirmDelete('{{ route('coord.turmas.delete',$turma->id) }}')" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors"><span class="ms">delete</span></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

@section('modals')
{{-- Modal Criar --}}
<div id="modalCriar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Nova Turma</h3>
            <button onclick="closeModal('modalCriar')" class="text-slate-400 hover:text-slate-600"><span class="ms">close</span></button>
        </div>
        <form method="POST" action="{{ route('coord.turmas.store') }}" class="px-6 py-4 space-y-4">
            @csrf
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Nome da Turma</label>
                <input type="text" name="nome" placeholder="Ex: SI-1A" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Semestre</label>
                <input type="text" name="semestre" placeholder="Ex: 1º Semestre" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Turno</label>
                <select name="turno" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Selecione...</option>
                    <option>Matutino</option><option>Vespertino</option><option>Noturno</option>
                </select></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Curso</label>
                <select name="curso_id" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Selecione...</option>
                    @foreach($cursos as $c)<option value="{{ $c->id }}">{{ $c->nome }}</option>@endforeach
                </select></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalCriar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-brand-800">Criar</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Editar --}}
<div id="modalEditar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Editar Turma</h3>
            <button onclick="closeModal('modalEditar')" class="text-slate-400 hover:text-slate-600"><span class="ms">close</span></button>
        </div>
        <form method="POST" id="formEditar" class="px-6 py-4 space-y-4">
            @csrf @method('PUT')
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Nome da Turma</label>
                <input type="text" name="nome" id="edit_nome" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Semestre</label>
                <input type="text" name="semestre" id="edit_semestre" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Turno</label>
                <select name="turno" id="edit_turno" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option>Matutino</option><option>Vespertino</option><option>Noturno</option>
                </select></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Curso</label>
                <select name="curso_id" id="edit_curso_id" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                    @foreach($cursos as $c)<option value="{{ $c->id }}">{{ $c->nome }}</option>@endforeach
                </select></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalEditar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-brand-800">Salvar</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Confirmar Delete --}}
<div id="modalDelete" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm modal-box p-6 text-center">
        <span class="ms ms-fill text-red-400 text-5xl mb-3 block">delete_forever</span>
        <h3 class="font-bold text-slate-800 mb-2">Confirmar exclusão</h3>
        <p class="text-sm text-slate-500 mb-6">Essa ação é irreversível e pode remover alunos e alocações vinculadas.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modalDelete')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50">Cancelar</button>
            <form id="formDelete" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-red-700">Excluir</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openModal(id){ document.getElementById(id).classList.remove('hidden'); }
function closeModal(id){ document.getElementById(id).classList.add('hidden'); }
function openEdit(t){
    document.getElementById('formEditar').action = `/coordenador/turmas/${t.id}`;
    document.getElementById('edit_nome').value = t.nome;
    document.getElementById('edit_semestre').value = t.semestre;
    document.getElementById('edit_turno').value = t.turno;
    document.getElementById('edit_curso_id').value = t.curso_id;
    openModal('modalEditar');
}
function confirmDelete(url){
    document.getElementById('formDelete').action = url;
    openModal('modalDelete');
}
document.querySelectorAll('.modal-overlay').forEach(m => m.addEventListener('click', function(e){ if(e.target===this) this.classList.add('hidden'); }));
</script>
@endsection
