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
            theme: {
                extend: {
                    colors: {
                        "primary": "#000032",
                        "primary-container": "#171a4a",
                        "secondary-container": "#ffd259",
                        "surface": "#fcf8fd",
                        "on-surface": "#1b1b1f",
                        "on-surface-variant": "#46464f",
                        "surface-container-low": "#f6f2f7",
                        "outline": "#777680",
                        "outline-variant": "#c7c5d0",
                    },
                    fontFamily: { sans: ["Manrope", "sans-serif"] },
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Manrope', sans-serif; }
        body { min-height: max(884px, 100dvh); background: #fcf8fd; }
        .step { opacity: 0.4; pointer-events: none; transition: opacity .3s; }
        .step.active { opacity: 1; pointer-events: auto; }
        .select-custom {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23777680' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-4">

    <!-- Header fixo -->
    <header class="fixed top-0 left-0 w-full z-50 flex items-center px-4 h-14 bg-[#171a4a] shadow-sm">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-white text-xl" style="font-variation-settings:'FILL' 1">school</span>
            <div>
                <span class="text-base font-extrabold text-white tracking-tight">MetaAgenda</span>
                <p class="text-[10px] font-medium text-white/60 uppercase tracking-widest -mt-0.5">Consulta Acadêmica</p>
            </div>
        </div>
    </header>

    <main class="w-full max-w-sm mt-14 flex flex-col items-center py-8">

        <!-- Ícone -->
        <div class="w-20 h-20 mb-6 rounded-full bg-[#171a4a] flex items-center justify-center shadow-lg">
            <span class="material-symbols-outlined text-white text-4xl" style="font-variation-settings:'FILL' 1">calendar_month</span>
        </div>

        <!-- Card -->
        <div class="w-full bg-white rounded-2xl border border-[#c7c5d0] shadow-sm p-6 space-y-5">
            <div class="text-center">
                <h1 class="text-xl font-extrabold text-[#1b1b1f]">Consultar Horários</h1>
                <p class="text-sm text-[#46464f] mt-1">Selecione seu curso, semestre e turno para ver sua grade de aulas.</p>
            </div>

            @if(session('error'))
            <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm font-medium">
                <span class="material-symbols-outlined text-base">error</span>
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('aluno.buscar') }}" class="space-y-4">
                @csrf

                {{-- PASSO 1: CURSO --}}
                <div>
                    <label class="block text-xs font-bold text-[#46464f] uppercase tracking-wider mb-1.5">
                        <span class="flex items-center gap-1">
                            <span class="w-5 h-5 rounded-full bg-[#171a4a] text-white text-[10px] flex items-center justify-center font-bold">1</span>
                            Curso
                        </span>
                    </label>
                    <select name="curso_id" id="selectCurso" onchange="carregarSemestres()"
                        class="select-custom w-full border border-[#c7c5d0] rounded-xl px-4 py-3 text-sm text-[#1b1b1f] bg-[#f6f2f7] focus:outline-none focus:ring-2 focus:ring-[#171a4a]">
                        <option value="">— Selecione o curso —</option>
                        @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                            {{ $curso->nome }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- PASSO 2: SEMESTRE --}}
                <div id="stepSemestre" class="step">
                    <label class="block text-xs font-bold text-[#46464f] uppercase tracking-wider mb-1.5">
                        <span class="flex items-center gap-1">
                            <span class="w-5 h-5 rounded-full bg-[#171a4a] text-white text-[10px] flex items-center justify-center font-bold">2</span>
                            Semestre
                        </span>
                    </label>
                    <select name="semestre" id="selectSemestre" onchange="carregarTurnos()"
                        class="select-custom w-full border border-[#c7c5d0] rounded-xl px-4 py-3 text-sm text-[#1b1b1f] bg-[#f6f2f7] focus:outline-none focus:ring-2 focus:ring-[#171a4a]">
                        <option value="">— Selecione o semestre —</option>
                    </select>
                </div>

                {{-- PASSO 3: TURNO --}}
                <div id="stepTurno" class="step">
                    <label class="block text-xs font-bold text-[#46464f] uppercase tracking-wider mb-1.5">
                        <span class="flex items-center gap-1">
                            <span class="w-5 h-5 rounded-full bg-[#171a4a] text-white text-[10px] flex items-center justify-center font-bold">3</span>
                            Turno
                        </span>
                    </label>
                    <select name="turno" id="selectTurno"
                        class="select-custom w-full border border-[#c7c5d0] rounded-xl px-4 py-3 text-sm text-[#1b1b1f] bg-[#f6f2f7] focus:outline-none focus:ring-2 focus:ring-[#171a4a]">
                        <option value="">— Selecione o turno —</option>
                    </select>
                </div>

                <button type="submit" id="btnConsultar"
                    class="w-full bg-[#171a4a] hover:bg-[#000032] text-white font-bold py-3.5 rounded-xl transition-colors flex items-center justify-center gap-2 disabled:opacity-40"
                    disabled>
                    <span class="material-symbols-outlined text-base">search</span>
                    Ver Horários
                </button>
            </form>

            <div class="pt-4 border-t border-[#c7c5d0] text-center space-y-2">
                <a href="{{ route('professor.consulta') }}" class="flex items-center justify-center gap-1.5 text-xs font-semibold text-[#46464f] hover:text-[#171a4a]">
                    <span class="material-symbols-outlined text-sm">cast_for_education</span>
                    Sou professor
                </a>
                <a href="{{ route('login.coordenador') }}" class="flex items-center justify-center gap-1.5 text-xs font-semibold text-[#46464f] hover:text-[#171a4a]">
                    <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                    Sou coordenador
                </a>
            </div>
        </div>

        <p class="text-center text-[#777680] text-xs mt-6">MetaAgenda · Sistema Acadêmico</p>
    </main>

</body>
<script>
async function carregarSemestres() {
    const cursoId = document.getElementById('selectCurso').value;
    const stepSem = document.getElementById('stepSemestre');
    const stepTur = document.getElementById('stepTurno');
    const btn = document.getElementById('btnConsultar');

    // Reset
    document.getElementById('selectSemestre').innerHTML = '<option value="">— Selecione o semestre —</option>';
    document.getElementById('selectTurno').innerHTML = '<option value="">— Selecione o turno —</option>';
    stepSem.classList.remove('active');
    stepTur.classList.remove('active');
    btn.disabled = true;

    if (!cursoId) return;

    const res = await fetch(`/aluno/turmas?curso_id=${cursoId}`);
    const data = await res.json();

    const sel = document.getElementById('selectSemestre');
    data.forEach(t => {
        const opt = document.createElement('option');
        opt.value = t.semestre;
        opt.textContent = t.semestre;
        sel.appendChild(opt);
    });

    if (data.length > 0) stepSem.classList.add('active');
}

async function carregarTurnos() {
    const cursoId = document.getElementById('selectCurso').value;
    const semestre = document.getElementById('selectSemestre').value;
    const stepTur = document.getElementById('stepTurno');
    const btn = document.getElementById('btnConsultar');

    document.getElementById('selectTurno').innerHTML = '<option value="">— Selecione o turno —</option>';
    stepTur.classList.remove('active');
    btn.disabled = true;

    if (!semestre) return;

    const res = await fetch(`/aluno/turnos?curso_id=${cursoId}&semestre=${encodeURIComponent(semestre)}`);
    const data = await res.json();

    const sel = document.getElementById('selectTurno');
    data.forEach(t => {
        const opt = document.createElement('option');
        opt.value = t.turno;
        opt.textContent = t.turno;
        sel.appendChild(opt);
    });

    if (data.length > 0) {
        stepTur.classList.add('active');
        sel.onchange = () => { btn.disabled = !sel.value; };
    }
}
</script>
</html>
