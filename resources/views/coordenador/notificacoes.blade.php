@extends('layouts.app')
@include('partials.sidebar-coord')
@section('title','Notificações')
@section('page-title','Notificações')
@section('page-subtitle','Envie comunicados para as turmas')

@section('header-actions')
<button onclick="openModal('modalCriar')" class="flex items-center gap-2 bg-brand-900 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-brand-800">
    <span class="ms">send</span> Enviar Notificação
</button>
@endsection

@section('content')
<div class="pt-2 space-y-4">
    @forelse($notificacoes as $notif)
    @php
    $tipos = ['urgente'=>['bg'=>'bg-red-50','border'=>'border-red-200','badge'=>'bg-red-100 text-red-700','icon'=>'priority_high','iconColor'=>'text-red-500'],
    'cancelamento'=>['bg'=>'bg-orange-50','border'=>'border-orange-200','badge'=>'bg-orange-100 text-orange-700','icon'=>'cancel','iconColor'=>'text-orange-500'],
    'alteração de sala'=>['bg'=>'bg-blue-50','border'=>'border-blue-200','badge'=>'bg-blue-100 text-blue-700','icon'=>'swap_horiz','iconColor'=>'text-blue-500']];
    $estilo = $tipos[$notif->tipo] ?? ['bg'=>'bg-white','border'=>'border-slate-200','badge'=>'bg-slate-100 text-slate-600','icon'=>'notifications','iconColor'=>'text-slate-400'];
    @endphp
    <div class="{{ $estilo['bg'] }} border {{ $estilo['border'] }} rounded-2xl p-5 flex gap-4 shadow-sm animate-in">
        <div class="flex-shrink-0 mt-0.5">
            <span class="ms ms-fill {{ $estilo['iconColor'] }} text-2xl">{{ $estilo['icon'] }}</span>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h4 class="font-bold text-slate-800">{{ $notif->titulo }}</h4>
                    <p class="text-sm text-slate-600 mt-1">{{ $notif->mensagem }}</p>
                    <div class="flex items-center gap-2 mt-2 flex-wrap">
                        <span class="px-2 py-0.5 bg-brand-50 text-brand-700 text-xs font-semibold rounded-full">{{ ($notif->turma->curso->nome ?? '') . ' - ' . ($notif->turma->semestre ?? '') . ' - ' . ($notif->turma->turno ?? '') }}</span>
                        @if($notif->tipo)<span class="px-2 py-0.5 {{ $estilo['badge'] }} text-xs font-semibold rounded-full">{{ $notif->tipo }}</span>@endif
                        <span class="text-xs text-slate-400">
                            {{ $notif->created_at ? $notif->created_at->diffForHumans() : '' }}
                        </span>
                    </div>
                </div>
                <button onclick="confirmDelete('{{ route('coord.notificacoes.delete',$notif->id) }}')" class="flex-shrink-0 p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                    <span class="ms">delete</span>
                </button>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl border border-slate-200 p-16 text-center shadow-sm">
        <span class="ms text-6xl text-slate-200 block mb-4">notifications_off</span>
        <p class="text-slate-500 font-semibold">Nenhuma notificação enviada.</p>
    </div>
    @endforelse
</div>
@endsection

@section('modals')
<div id="modalCriar" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 flex items-center gap-2"><span class="ms text-amber-500">notifications_active</span> Enviar Notificação</h3>
            <button onclick="closeModal('modalCriar')" class="text-slate-400"><span class="ms">close</span></button>
        </div>
        <form method="POST" action="{{ route('coord.notificacoes.store') }}" class="px-6 py-4 space-y-4">
            @csrf
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Turma Destinatária</label>
                <select name="turma_id" required class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Selecione a turma...</option>
                    @foreach($turmas as $t)<option value="{{ $t->id }}">{{ $t->curso->nome ?? '' }} — {{ $t->semestre }} — {{ $t->turno }}</option>@endforeach
                </select>
            </div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Título</label>
                <input type="text" name="titulo" required placeholder="Ex: Aula cancelada" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Mensagem</label>
                <textarea name="mensagem" required rows="3" placeholder="Detalhes do comunicado..." class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 resize-none"></textarea>
            </div>
            <div><label class="block text-xs font-semibold text-slate-600 mb-1">Tipo</label>
                <select name="tipo" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Aviso Geral</option>
                    <option value="urgente">🚨 Urgente</option>
                    <option value="cancelamento">❌ Cancelamento</option>
                    <option value="alteração de sala">🔁 Alteração de Sala</option>
                    <option value="institucional">🏛️ Institucional</option>
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modalCriar')" class="flex-1 border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold">Cancelar</button>
                <button type="submit" class="flex-1 bg-brand-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center justify-center gap-2"><span class="ms">send</span> Enviar</button>
            </div>
        </form>
    </div>
</div>
<div id="modalDelete" class="hidden fixed inset-0 z-50 modal-overlay bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm modal-box p-6 text-center">
        <span class="ms ms-fill text-red-400 text-5xl mb-3 block">delete_forever</span>
        <p class="text-sm text-slate-500 mb-6">Remover esta notificação?</p>
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
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function confirmDelete(url) {
        document.getElementById('formDelete').action = url;
        openModal('modalDelete');
    }
    document.querySelectorAll('.modal-overlay').forEach(m => m.addEventListener('click', function(e) {
        if (e.target === this) this.classList.add('hidden');
    }));
</script>
@endsection