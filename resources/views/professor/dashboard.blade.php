<!DOCTYPE html>
<html class="light" lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary-container": "#1a3a1a",
                        "surface-container-low": "#f3f7f3",
                        "on-surface": "#1b1b1f",
                        "on-surface-variant": "#46464f",
                        "outline": "#777680",
                        "outline-variant": "#c7c5d0",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                    },
                    fontFamily: { sans: ["Manrope", "sans-serif"] },
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Manrope', sans-serif; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        body { min-height: max(884px, 100dvh); }
        .accordion-content { display: none; }
        .accordion-content.open { display: block; }
    </style>
</head>

<body class="bg-[#f6f9f6] text-[#1b1b1f] min-h-screen pb-24">

    <!-- Header -->
    <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 h-16 bg-[#1a3a1a] text-white shadow-sm border-b border-white/10">
        <div class="flex flex-col">
            <span class="text-xl font-extrabold tracking-tight text-white">MetaAgenda</span>
            <span class="text-[10px] font-medium uppercase tracking-wider opacity-70">Professor</span>
        </div>
        <form method="POST" action="{{ route('professor.logout') }}">
            @csrf
            <button type="submit" class="material-symbols-outlined text-white p-2 hover:bg-white/10 rounded-full transition-all">logout</button>
        </form>
    </header>

    <main class="mt-16 px-4 pt-4 space-y-4">

        {{-- Welcome --}}
        <section class="relative overflow-hidden bg-[#1a3a1a] rounded-xl p-4 shadow-sm">
            <div class="relative z-10 flex flex-col space-y-3">
                <div>
                    <h1 class="text-white text-lg font-extrabold">{{ $professor->nome }}</h1>
                    <p class="text-white/60 text-xs font-medium uppercase tracking-wider mt-0.5">Professor</p>
                </div>
                {{-- Resumo semanal --}}
                @php
                    $diasMap = [0=>'Domingo',1=>'Segunda',2=>'Terça',3=>'Quarta',4=>'Quinta',5=>'Sexta',6=>'Sábado'];
                    $diaHoje = $diasMap[now()->dayOfWeek];
                    $agoraStr = now()->format('H:i');
                    $proxima = $alocacoes->where('dia_semana', $diaHoje)
                        ->filter(fn($a) => substr($a->hora_inicio,0,5) >= $agoraStr)
                        ->sortBy('hora_inicio')->first();
                @endphp
                <div class="bg-[#2d6a2d] rounded-lg p-3 flex items-center justify-between shadow-md">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/10 p-2 rounded-lg">
                            <span class="material-symbols-outlined text-white">cast_for_education</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-white/60 uppercase tracking-tighter">Próxima Aula Hoje</p>
                            <h3 class="font-bold text-white text-sm leading-tight">{{ $proxima->disciplina->nome ?? 'Sem aula hoje' }}</h3>
                        </div>
                    </div>
                    @if($proxima)
                    <div class="text-right">
                        <span class="block font-bold text-white text-sm">{{ substr($proxima->hora_inicio,0,5) }}</span>
                        <span class="block text-[10px] font-medium text-white/70">{{ $proxima->sala->nome ?? '' }}</span>
                    </div>
                    @endif
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-2 mt-1">
                    <div class="bg-white/10 rounded-lg px-3 py-2 text-center">
                        <p class="text-xl font-extrabold text-white">{{ $alocacoes->count() }}</p>
                        <p class="text-[10px] text-white/60 font-semibold">Aulas/sem.</p>
                    </div>
                    <div class="bg-white/10 rounded-lg px-3 py-2 text-center">
                        <p class="text-xl font-extrabold text-white">{{ $alocacoes->pluck('dia_semana')->unique()->count() }}</p>
                        <p class="text-[10px] text-white/60 font-semibold">Dias letivos</p>
                    </div>
                    <div class="bg-white/10 rounded-lg px-3 py-2 text-center">
                        <p class="text-xl font-extrabold text-white">{{ $alocacoes->flatMap->turmas->pluck('id')->unique()->count() }}</p>
                        <p class="text-[10px] text-white/60 font-semibold">Turmas</p>
                    </div>
                </div>
            </div>
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/5 rounded-full blur-3xl"></div>
        </section>

        {{-- Cronograma --}}
        <section class="space-y-2">
            <h2 class="text-base font-bold text-on-surface px-1">Cronograma Semanal</h2>

            @php
            $dias = ['Segunda'=>'SEG','Terça'=>'TER','Quarta'=>'QUA','Quinta'=>'QUI','Sexta'=>'SEX','Sábado'=>'SAB'];
            @endphp

            @foreach($dias as $diaNome => $diaAbrev)
            @php $aulas = $alocacoes->where('dia_semana', $diaNome)->sortBy('hora_inicio'); $total = $aulas->count(); @endphp
            <div class="border border-[#c7c5d0] rounded-xl overflow-hidden bg-white shadow-sm accordion-item">
                <button type="button" class="accordion-btn w-full px-4 py-3 flex items-center justify-between bg-[#f3f7f3]">
                    <div class="flex items-center space-x-3">
                        <span class="font-extrabold text-[#1a3a1a] w-8 text-left">{{ $diaAbrev }}</span>
                        <span class="w-1 h-1 rounded-full bg-[#c7c5d0]"></span>
                        <span class="text-sm font-medium text-[#46464f]">
                            {{ $total > 0 ? $total . ' Disciplina' . ($total > 1 ? 's' : '') : 'Sem aulas' }}
                        </span>
                    </div>
                    <span class="material-symbols-outlined text-[#777680] accordion-icon">chevron_right</span>
                </button>

                <div class="accordion-content px-4 py-2 space-y-0">
                    @forelse($aulas as $aula)
                    <div class="flex items-start space-x-3 py-3 border-b border-dashed border-[#c7c5d0] last:border-0">
                        <div class="flex flex-col items-center min-w-[52px]">
                            <span class="text-xs font-extrabold text-[#1a3a1a]">{{ substr($aula->hora_inicio,0,5) }}</span>
                            <div class="w-px h-3 bg-[#c7c5d0] my-0.5"></div>
                            <span class="text-[10px] text-[#777680]">{{ substr($aula->hora_fim,0,5) }}</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-on-surface leading-tight">{{ $aula->disciplina->nome ?? '—' }}</h4>
                            <div class="flex flex-wrap gap-x-3 gap-y-1 mt-1.5">
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
                            {{-- Turmas --}}
                            @if($aula->turmas->count() > 0)
                            <div class="mt-1.5 flex flex-wrap gap-1">
                                @foreach($aula->turmas as $t)
                                <span class="text-[10px] px-1.5 py-0.5 bg-[#1a3a1a]/10 text-[#1a3a1a] rounded font-semibold">{{ $t->nome }}</span>
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

            @if($alocacoes->isEmpty())
            <div class="bg-white border border-[#c7c5d0] rounded-xl p-10 text-center shadow-sm">
                <span class="material-symbols-outlined text-5xl text-[#c7c5d0] block mb-3">calendar_month</span>
                <p class="text-sm text-[#46464f] font-semibold">Nenhuma aula alocada para você ainda.</p>
            </div>
            @endif
        </section>

    </main>

    {{-- BottomNav --}}
    <nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-2 py-3 pb-safe bg-white border-t border-slate-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.08)] rounded-t-lg">
        <button onclick="window.scrollTo({top:0,behavior:'smooth'})" class="flex flex-col items-center justify-center text-[#1a3a1a] bg-[#f3f7f3] rounded-xl px-5 py-1 transition-transform active:scale-90">
            <span class="material-symbols-outlined text-lg" style="font-variation-settings:'FILL' 1">home</span>
            <span class="text-[11px] font-semibold">Início</span>
        </button>
        <form method="POST" action="{{ route('professor.logout') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#1a3a1a] transition-colors">
            @csrf
            <button type="submit" class="flex flex-col items-center">
                <span class="material-symbols-outlined text-lg">logout</span>
                <span class="text-[11px] font-semibold">Sair</span>
            </button>
        </form>
    </nav>

</body>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.accordion-item').forEach(item => {
        const btn     = item.querySelector('.accordion-btn');
        const content = item.querySelector('.accordion-content');
        const icon    = item.querySelector('.accordion-icon');

        btn.addEventListener('click', () => {
            const isOpen = content.classList.contains('open');
            document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('open'));
            document.querySelectorAll('.accordion-icon').forEach(i => i.innerText = 'chevron_right');
            if (!isOpen) {
                content.classList.add('open');
                icon.innerText = 'expand_more';
            }
        });
    });
});
</script>
</html>
