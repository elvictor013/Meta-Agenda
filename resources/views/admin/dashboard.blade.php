@extends('layouts.app')
@include('partials.sidebar-coord')
@section('title', 'Painel Administrativo')
@section('page-title', 'Painel Administrativo')
@section('page-subtitle', 'Gerencie cursos e coordenadores')

@section('header-actions')
<button onclick="openModal('modalCursoCriar')" class="flex items-center gap-2 bg-brand-900 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-brand-800">
    <span class="ms">add</span> Novo Curso
</button>
<button onclick="openModal('modalCoordCriar')" class="flex items-center gap-2 bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-emerald-800">
    <span class="ms">person_add</span> Novo Coordenador
</button>
@endsection

@section('content')
<div class="pt-2 space-y-8">

    {{-- CURSOS --}}
    <section>
        <h3 class="font-bold text-slate-700 text-sm uppercase tracking-wider mb-4 flex items-center gap-2">
            <span class="ms text-brand-600">folder</span> Cursos ({{ $cursos->count() }})
        </h3>
        @if($cursos->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center shadow-sm">
            <span class="ms text-5xl text-slate-200 block mb-3">folder_open</span>
            <p class="text-slate-500 font-semibold text-sm">Nenhum curso cadastrado ainda.</p>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($cursos as $curso)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center">
                        <span class="ms text-brand-600">folder</span>
                    </div>
                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button onclick='openEditCurso(@json($curso))' class="p-1.5 rounded-lg text-slate-400 hover:text-brand-600 hover:bg-brand-50"><span class="ms text-lg">edit</span></button>
                        <button onclick="confirmDeleteCurso('{{ route('admin.curso.delete', $curso->id) }}')" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50"><span class="ms text-lg">delete</span></button>
                    </div>
                </div>
                <p class="font-bold text-slate-800">{{ $curso->nome }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $curso->coordenadores->count() ?? 0 }} coordenador(es)</p>
            </div>
            @endforeach
        </div>
        @endif
    </section>

    {{-- COORDENADORES --}}
    <section>
        <h3 class="font-bold text-slate-700 text-sm uppercase tracking-wider mb-4 flex items-center gap-2">
            <span class="ms text-emerald-600">manage_accounts</span> Coordenadores ({{ $coordenadores->count() }})
        </h3>
        @if($coordenadores->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center shadow-sm">
            <span class="ms text-5xl text-slate-200 block mb-3">person_off</span>
            <p class="text-slate-500 font-semibold text-sm">Nenhum coordenador cadastrado.</p>
        </div>
        @else
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold text-slate-600">Coordenador</th>
                        <th class="text-left px-6 py-3 font-semibold text-slate-600">CPF</th>
                        <th class="text-left px-6 py-3 font-semibold text-slate-600">Cursos</th>
                        <th class="text-left px-6 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-right px-6 py-3 font-semibold text-slate-600">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($coordenadores as $coord)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-brand-900 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                    {{ strtoupper(substr($coord->nome, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $coord->nome }}</p>
                                    @if($coord->is_admin)<span class="px-1.5 py-0.5 bg-amber-100 text-amber-700 text-[10px] font-bold rounded">Admin</span>@endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ $coord->cpf }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @forelse($coord->cursos as $c)
                                <span class="px-2 py-0.5 bg-brand-50 text-brand-700 text-xs font-semibold rounded-full">{{ $c->nome }}</span>
                                @empty
                                <span class="text-xs text-slate-400">Nenhum</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($coord->ativo)
                            <span class="px-2 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full">Ativo</span>
                            @else
                            <span class="px-2 py-1 bg-red-50 text-red-600 text-xs font-bold rounded-full">Inativo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex gap-1 justify-end">
                                <button onclick='openEditCoord(@json($coord->load("cursos")))' class="p-1.5 rounded-lg text-slate-400 hover:text-brand-600 hover:bg-brand-50 transition-colors"><span class="ms">edit</span></button>
                                <form method="POST" action="{{ route('admin.coord.toggle', $coord->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-colors" title="{{ $coord->ativo ? 'Desativar' : 'Ativar' }}">
                                        <span class="ms">{{ $coord->ativo ? 'toggle_on' : 'toggle_off' }}</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </section>
</div>
@endsection

@section('modals')
{{-- Modal Criar Curso --}}
<div id="modalCursoCriar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Novo Curso</h3>
            <button onclick="closeModal('modalCursoCriar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" action="{{ route('admin.curso.store') }}" class="px-6 py-4 space-y-4">
            @csrf
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Nome do Curso</label>
                <input type="text" name="nome" required placeholder="Ex: Sistemas para Internet" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalCursoCriar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Criar Curso</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Editar Curso --}}
<div id="modalCursoEditar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Editar Curso</h3>
            <button onclick="closeModal('modalCursoEditar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" id="formEditCurso" class="px-6 py-4 space-y-4">
            @csrf @method('PUT')
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Nome</label>
                <input type="text" name="nome" id="editCursoNome" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalCursoEditar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Salvar</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Delete Curso --}}
<div id="modalCursoDelete" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm modal-box p-6 text-center">
        <span class="ms ms-fill text-red-400 text-5xl mb-3 block">delete_forever</span>
        <h3 class="font-bold text-slate-800 mb-1">Excluir Curso?</h3>
        <p class="text-sm text-slate-500 mb-6">Esta ação é irreversível e pode remover turmas, disciplinas e alocações vinculadas.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modalCursoDelete')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
            <form id="formDeleteCurso" method="POST" class="flex-1">@csrf @method('DELETE')
                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Excluir</button>
            </form>
        </div>
    </div>
</div>

{{-- Modal Criar Coordenador --}}
<div id="modalCoordCriar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Novo Coordenador</h3>
            <button onclick="closeModal('modalCoordCriar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" action="{{ route('admin.coord.store') }}" class="px-6 py-4 space-y-4">
            @csrf
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Nome Completo</label>
                <input type="text" name="nome" required placeholder="Nome do coordenador" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">CPF <span class="text-slate-400">(somente números)</span></label>
                <input type="text" name="cpf" required maxlength="11" placeholder="00000000000" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Senha</label>
                <input type="password" name="password" required placeholder="Mínimo 6 caracteres" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Cursos Vinculados</label>
                <div class="border border-slate-200 rounded-xl p-3 max-h-36 overflow-y-auto space-y-1.5">
                    @foreach($cursos as $c)
                    <label class="flex items-center gap-2 cursor-pointer hover:bg-slate-50 rounded-lg px-2 py-1">
                        <input type="checkbox" name="cursos[]" value="{{ $c->id }}" class="rounded">
                        <span class="text-sm text-slate-700">{{ $c->nome }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalCoordCriar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
                <button type="submit" class="flex-1 bg-emerald-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Criar</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Editar Coordenador --}}
<div id="modalCoordEditar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Editar Coordenador</h3>
            <button onclick="closeModal('modalCoordEditar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" id="formEditCoord" class="px-6 py-4 space-y-4">
            @csrf @method('PUT')
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Nome</label>
                <input type="text" name="nome" id="editCoordNome" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">CPF</label>
                <input type="text" name="cpf" id="editCoordCpf" required maxlength="11" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-brand-500"></div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Cursos Vinculados</label>
                <div class="border border-slate-200 rounded-xl p-3 max-h-36 overflow-y-auto space-y-1.5">
                    @foreach($cursos as $c)
                    <label class="flex items-center gap-2 cursor-pointer hover:bg-slate-50 rounded-lg px-2 py-1">
                        <input type="checkbox" name="cursos[]" value="{{ $c->id }}" class="coord-curso-check rounded">
                        <span class="text-sm text-slate-700">{{ $c->nome }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalCoordEditar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openModal(id){ document.getElementById(id).classList.remove('hidden'); }
function closeModal(id){ document.getElementById(id).classList.add('hidden'); }

function openEditCurso(c){
    document.getElementById('formEditCurso').action = `/admin/curso/${c.id}`;
    document.getElementById('editCursoNome').value = c.nome;
    openModal('modalCursoEditar');
}
function confirmDeleteCurso(url){
    document.getElementById('formDeleteCurso').action = url;
    openModal('modalCursoDelete');
}
function openEditCoord(c){
    document.getElementById('formEditCoord').action = `/admin/coordenador/${c.id}`;
    document.getElementById('editCoordNome').value = c.nome;
    document.getElementById('editCoordCpf').value = c.cpf;
    const ids = (c.cursos || []).map(x => String(x.id));
    document.querySelectorAll('.coord-curso-check').forEach(cb => {
        cb.checked = ids.includes(cb.value);
    });
    openModal('modalCoordEditar');
}
document.querySelectorAll('.modal-overlay').forEach(m => m.addEventListener('click', function(e){ if(e.target===this) this.classList.add('hidden'); }));
</script>
@endsection
