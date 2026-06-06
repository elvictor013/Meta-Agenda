<!DOCTYPE html>
<html class="light" lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        * { font-family: 'Manrope', sans-serif; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        body { min-height: max(884px, 100dvh); }
        .accordion-content { display: none; }
        .accordion-content.open { display: block; }
    </style>
</head>
<body class="bg-[#fcf8fd] text-[#1b1b1f] min-h-screen pb-24">

    <!-- Header -->
    <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 h-16 bg-[#171a4a] text-white shadow-sm">
        <div class="flex flex-col">
            <span class="text-xl font-extrabold tracking-tight">MetaAgenda</span>
            <span class="text-[10px] font-medium uppercase tracking-wider opacity-70">{{ $turma->curso->nome ?? '' }}</span>
        </div>
        <form method="POST" action="{{ route('aluno.logout') }}">
            @csrf
            <button type="submit" class="material-symbols-outlined text-white p-2 hover:bg-white/10 rounded-full">logout</button>
        </form>
    </header>

    <main class="mt-16 px-4 pt-4 space-y-4">

        {{-- Welcome --}}
        <section class="relative overflow-hidden bg-[#171a4a] rounded-xl p-4 shadow-sm">
            <div class="relative z-10 flex flex-col space-y-3">
                <div>
                    <h1 class="text-white text-lg font-extrabold">{{ $turma->semestre }} — {{ $turma->turno }}</h1>
                    <p class="text-white/60 text-xs font-medium mt-0.5">{{ $turma->curso->nome ?? '' }}</p>
                </div>

                {{-- Próxima Aula --}}
                <div class="bg-[#dbb13b] rounded-lg p-3 flex items-center justify-between shadow-md">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#171a4a]/10 p-2 rounded-lg">
                            <span class="material-symbols-outlined text-[#171a4a]">school</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-[#171a4a]/60 uppercase tracking-tighter">Agora na Sequência</p>
                            <h3 class="font-bold text-[#171a4a] text-sm leading-tight">
                                {{ $proxima->disciplina->nome ?? 'Sem aula agora' }}
                            </h3>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block font-bold text-[#171a4a] text-sm">{{ $proxima ? substr($proxima->hora_inicio,0,5) : '--:--' }}</span>
                        <span class="block text-[10px] font-medium text-[#171a4a]/80">{{ $proxima->sala->nome ?? '---' }}</span>
                    </div>
                </div>
            </div>
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/5 rounded-full blur-3xl"></div>
        </section>

        {{-- Cronograma --}}
        <section class="space-y-2">
            <h2 class="text-base font-bold text-[#1b1b1f] px-1">Cronograma Semanal</h2>

            @php
            $dias = ['Segunda'=>'SEG','Terça'=>'TER','Quarta'=>'QUA','Quinta'=>'QUI','Sexta'=>'SEX'];
            @endphp

            @foreach($dias as $diaNome => $diaAbrev)
            @php
                $aulas = $alocacoes->where('dia_semana', $diaNome)->sortBy('hora_inicio');
                $total = $aulas->count();
            @endphp
            <div class="border border-[#c7c5d0] rounded-xl overflow-hidden bg-white shadow-sm accordion-item">
                <button type="button" class="accordion-btn w-full px-4 py-3 flex items-center justify-between bg-[#f6f2f7]">
                    <div class="flex items-center space-x-3">
                        <span class="font-extrabold text-[#171a4a] w-8 text-left">{{ $diaAbrev }}</span>
                        <span class="w-1 h-1 rounded-full bg-[#c7c5d0]"></span>
                        <span class="text-sm font-medium text-[#46464f]">
                            {{ $total > 0 ? $total . ' Disciplina' . ($total > 1 ? 's' : '') : 'Sem aulas' }}
                        </span>
                    </div>
                    <span class="material-symbols-outlined text-[#777680] accordion-icon">chevron_right</span>
                </button>
                <div class="accordion-content px-4 py-2">
                    @forelse($aulas as $aula)
                    <div class="flex items-start space-x-3 py-3 border-b border-dashed border-[#c7c5d0] last:border-0">
                        <div class="flex flex-col items-center min-w-[52px]">
                            <span class="text-xs font-extrabold text-[#171a4a]">{{ substr($aula->hora_inicio,0,5) }}</span>
                            <div class="w-px h-3 bg-[#c7c5d0] my-0.5"></div>
                            <span class="text-[10px] text-[#777680]">{{ substr($aula->hora_fim,0,5) }}</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-[#1b1b1f] leading-tight">{{ $aula->disciplina->nome ?? '—' }}</h4>
                            <div class="flex flex-wrap gap-x-3 gap-y-1 mt-1.5">
                                <span class="flex items-center text-[11px] text-[#46464f] gap-0.5">
                                    <span class="material-symbols-outlined text-[14px]">person</span>
                                    {{ $aula->professor->nome ?? '—' }}
                                </span>
                                <span class="flex items-center text-[11px] text-[#46464f] gap-0.5">
                                    <span class="material-symbols-outlined text-[14px]">meeting_room</span>
                                    {{ $aula->sala->nome ?? '—' }}
                                </span>
                                @if($aula->observacao)
                                <span class="flex items-center text-[11px] text-[#46464f] gap-0.5">
                                    <span class="material-symbols-outlined text-[14px]">info</span>
                                    {{ $aula->observacao }}
                                </span>
                                @endif
                            </div>
                            @if($aula->turmas->count() > 1)
                            <div class="mt-1.5 flex flex-wrap gap-1">
                                @foreach($aula->turmas as $t)
                                <span class="text-[10px] px-1.5 py-0.5 bg-[#171a4a]/10 text-[#171a4a] rounded font-semibold">
                                    {{ $t->semestre }} · {{ $t->turno }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-[#777680] py-3">Sem aulas neste dia.</p>
                    @endforelse
                </div>
            </div>
            @endforeach
        </section>

        {{-- Mural de Avisos --}}
        <section id="avisos" class="space-y-2">
            <h2 class="text-base font-bold text-[#1b1b1f] px-1">Mural de Avisos</h2>

            @forelse($notificacoes as $n)
            @php
                $borderColor = match(strtolower($n->tipo ?? '')) {
                    'urgente'           => 'border-red-500',
                    'cancelamento'      => 'border-orange-500',
                    'alteração de sala' => 'border-blue-500',
                    'institucional'     => 'border-[#171a4a]',
                    default             => 'border-gray-400',
                };
                $badgeColor = match(strtolower($n->tipo ?? '')) {
                    'urgente'           => 'bg-red-100 text-red-700',
                    'cancelamento'      => 'bg-orange-100 text-orange-700',
                    'alteração de sala' => 'bg-blue-100 text-blue-700',
                    'institucional'     => 'bg-[#171a4a]/10 text-[#171a4a]',
                    default             => 'bg-gray-100 text-gray-700',
                };
            @endphp
            <div class="bg-white border-l-4 {{ $borderColor }} rounded-r-lg p-3 shadow-sm">
                <div class="flex justify-between items-start mb-1">
                    @if($n->tipo)
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded uppercase {{ $badgeColor }}">{{ $n->tipo }}</span>
                    @else <span></span>
                    @endif
                    <span class="text-[10px] text-[#777680] font-medium">{{ optional($n->created_at)->format('d/m/Y') }}</span>
                </div>
                <h4 class="text-sm font-bold text-[#1b1b1f] mt-1">{{ $n->titulo }}</h4>
                <p class="text-xs text-[#46464f] mt-1">{{ $n->mensagem }}</p>
            </div>
            @empty
            <div class="bg-white border border-[#c7c5d0] rounded-xl p-6 text-center shadow-sm">
                <span class="material-symbols-outlined text-3xl text-[#c7c5d0] block mb-2">notifications_none</span>
                <p class="text-sm text-[#46464f] font-medium">Nenhum aviso no momento.</p>
            </div>
            @endforelse
        </section>

    </main>

    {{-- BottomNav --}}
    <nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-2 py-3 pb-safe bg-white border-t border-slate-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.08)] rounded-t-lg">
        <button onclick="window.scrollTo({top:0,behavior:'smooth'})" class="flex flex-col items-center text-[#171a4a] bg-slate-100 rounded-xl px-5 py-1">
            <span class="material-symbols-outlined text-lg" style="font-variation-settings:'FILL' 1">home</span>
            <span class="text-[11px] font-semibold">Início</span>
        </button>
        <a href="#avisos" class="flex flex-col items-center text-slate-500">
            <span class="material-symbols-outlined text-lg">campaign</span>
            <span class="text-[11px] font-semibold">Avisos</span>
        </a>
        <form method="POST" action="{{ route('aluno.logout') }}">
            @csrf
            <button type="submit" class="flex flex-col items-center text-slate-500">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                <span class="text-[11px] font-semibold">Voltar</span>
            </button>
        </form>
    </nav>

</body>
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.accordion-item').forEach(item => {
        const btn = item.querySelector('.accordion-btn');
        const content = item.querySelector('.accordion-content');
        const icon = item.querySelector('.accordion-icon');
        btn.addEventListener('click', () => {
            const isOpen = content.classList.contains('open');
            document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('open'));
            document.querySelectorAll('.accordion-icon').forEach(i => i.innerText = 'chevron_right');
            if (!isOpen) { content.classList.add('open'); icon.innerText = 'expand_more'; }
        });
    });
});
</script>
</html>
