@extends('layouts.app')
@include('partials.sidebar-coord')
@section('title','Salas')
@section('page-title','Salas')
@section('page-subtitle','Gerencie os espaços físicos')

@section('header-actions')
<button onclick="openModal('modalCriar')" class="flex items-center gap-2 bg-brand-900 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-brand-800">
    <span class="ms">add</span> Nova Sala
</button>
@endsection

@section('content')
<div class="pt-2">
    @if($salas->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-200 p-16 text-center shadow-sm">
        <span class="ms text-6xl text-slate-200 block mb-4">meeting_room</span>
        <p class="text-slate-500 font-semibold">Nenhuma sala cadastrada.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($salas as $sala)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                    <span class="ms text-slate-600">meeting_room</span>
                </div>
                <div class="flex gap-1">
                    <button onclick='openEdit(@json($sala))' class="p-1.5 rounded-lg text-slate-400 hover:text-brand-600 hover:bg-brand-50"><span class="ms text-lg">edit</span></button>
                    <button onclick="confirmDelete('{{ route('coord.salas.delete',$sala->id) }}')" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50"><span class="ms text-lg">delete</span></button>
                </div>
            </div>
            <p class="font-bold text-slate-800 text-lg">{{ $sala->nome }}</p>
            @if($sala->tipo)<p class="text-xs text-slate-500 mt-0.5">{{ $sala->tipo }}</p>@endif
            @if($sala->capacidade)
            <div class="mt-3 flex items-center gap-1.5 text-xs text-slate-500">
                <span class="ms text-sm">people</span> {{ $sala->capacidade }} lugares
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

@section('modals')
<div id="modalCriar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Nova Sala</h3>
            <button onclick="closeModal('modalCriar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" action="{{ route('coord.salas.store') }}" class="px-6 py-4 space-y-4">
            @csrf
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Nome / Código</label>
                <input type="text" name="nome" required placeholder="Ex: Sala 101" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div class="grid grid-cols-2 gap-3">
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Capacidade</label>
                    <input type="number" name="capacidade" placeholder="Ex: 40" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Tipo</label>
                    <select name="tipo" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Padrão</option>
                        <option>Laboratório</option><option>Auditório</option><option>Biblioteca</option>
                    </select></div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalCriar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Criar</button>
            </div>
        </form>
    </div>
</div>
<div id="modalEditar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Editar Sala</h3>
            <button onclick="closeModal('modalEditar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" id="formEditar" class="px-6 py-4 space-y-4">
            @csrf @method('PUT')
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Nome / Código</label>
                <input type="text" name="nome" id="edit_nome" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div class="grid grid-cols-2 gap-3">
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Capacidade</label>
                    <input type="number" name="capacidade" id="edit_cap" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
                <div><label class="block text-xs font-semibold text-slate-600 mb-1">Tipo</label>
                    <select name="tipo" id="edit_tipo" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Padrão</option><option>Laboratório</option><option>Auditório</option><option>Biblioteca</option>
                    </select></div>
            </div>
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
        <p class="text-sm text-slate-500 mb-6">Excluir esta sala? Alocações vinculadas serão removidas.</p>
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
function openEdit(s){
    document.getElementById('formEditar').action = `/coordenador/salas/${s.id}`;
    document.getElementById('edit_nome').value = s.nome;
    document.getElementById('edit_cap').value = s.capacidade || '';
    document.getElementById('edit_tipo').value = s.tipo || '';
    openModal('modalEditar');
}
function confirmDelete(url){ document.getElementById('formDelete').action = url; openModal('modalDelete'); }
document.querySelectorAll('.modal-overlay').forEach(m => m.addEventListener('click', function(e){ if(e.target===this) this.classList.add('hidden'); }));
</script>
@endsection
