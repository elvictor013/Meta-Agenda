@extends('layouts.app')
@include('partials.sidebar-coord')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Visão geral da coordenação')

@section('content')
<div class="pt-2 space-y-6">
    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @php
        $stats = [
            ['label'=>'Alocações','value'=>$totalAlocacoes,'icon'=>'calendar_month','color'=>'bg-brand-900','light'=>'bg-brand-50 text-brand-700'],
            ['label'=>'Turmas','value'=>$totalTurmas,'icon'=>'groups','color'=>'bg-violet-700','light'=>'bg-violet-50 text-violet-700'],
            ['label'=>'Professores','value'=>$totalProfessores,'icon'=>'person_search','color'=>'bg-emerald-700','light'=>'bg-emerald-50 text-emerald-700'],
            ['label'=>'Alunos','value'=>$totalAlunos,'icon'=>'school','color'=>'bg-amber-600','light'=>'bg-amber-50 text-amber-700'],
        ];
        @endphp
        @foreach($stats as $s)
        <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl {{ $s['color'] }} flex items-center justify-center flex-shrink-0">
                <span class="ms ms-fill text-white text-2xl">{{ $s['icon'] }}</span>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-slate-900">{{ $s['value'] }}</p>
                <p class="text-xs text-slate-500 font-semibold">{{ $s['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Alocações Recentes --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <span class="ms text-brand-600">calendar_month</span> Alocações Recentes
                </h3>
                <a href="{{ route('coord.alocacoes') }}" class="text-xs font-semibold text-brand-600 hover:underline flex items-center gap-1">
                    Ver todas <span class="ms text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($alocacoesRecentes as $aloc)
                <div class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                        <span class="ms text-brand-600">book</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-sm text-slate-800 truncate">{{ $aloc->disciplina->nome ?? '—' }}</p>
                        <p class="text-xs text-slate-500">{{ $aloc->professor->nome ?? '—' }} · {{ $aloc->sala->nome ?? '—' }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span class="inline-block px-2 py-0.5 bg-brand-50 text-brand-700 text-xs font-bold rounded-full">{{ $aloc->dia_semana }}</span>
                        <p class="text-xs text-slate-400 mt-0.5">{{ substr($aloc->hora_inicio,0,5) }}–{{ substr($aloc->hora_fim,0,5) }}</p>
                    </div>
                </div>
                @empty
                <div class="px-6 py-10 text-center text-slate-400 text-sm">
                    <span class="ms text-4xl block mb-2 text-slate-200">calendar_month</span>
                    Nenhuma alocação ainda.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Notificações Recentes --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <span class="ms text-amber-500">notifications</span> Notificações
                </h3>
                <a href="{{ route('coord.notificacoes') }}" class="text-xs font-semibold text-brand-600 hover:underline">Ver todas</a>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($notificacoesRecentes as $notif)
                @php
                $cores = ['urgente'=>'bg-red-50 text-red-700','cancelamento'=>'bg-orange-50 text-orange-700','padrão'=>'bg-slate-100 text-slate-600'];
                $cor = $cores[$notif->tipo] ?? $cores['padrão'];
                @endphp
                <div class="px-6 py-4 hover:bg-slate-50 transition-colors">
                    <div class="flex items-start gap-3">
                        <span class="ms ms-fill text-amber-400 mt-0.5">notifications_active</span>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm text-slate-800 truncate">{{ $notif->titulo }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $notif->turma->nome ?? '—' }}</p>
                            @if($notif->tipo)
                            <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-xs font-semibold {{ $cor }}">{{ $notif->tipo }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-10 text-center text-slate-400 text-sm">
                    <span class="ms text-4xl block mb-2 text-slate-200">notifications_off</span>
                    Sem notificações.
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Cursos do coordenador --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-6 py-5">
        <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2"><span class="ms text-brand-600">folder</span> Cursos que você gerencia</h3>
        <div class="flex flex-wrap gap-3">
            @foreach($coordenador->cursos as $curso)
            <span class="px-4 py-2 bg-brand-50 text-brand-800 text-sm font-semibold rounded-full border border-brand-100">{{ $curso->nome }}</span>
            @endforeach
        </div>
    </div>
</div>
@endsection
