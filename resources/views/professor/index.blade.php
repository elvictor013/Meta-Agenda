<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MetaAgenda — Professor</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',500:'#6366f1',600:'#4f46e5',700:'#4338ca',800:'#3730a3',900:'#1e1b4b' },
                    },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        .ms { font-family: 'Material Symbols Rounded'; font-variation-settings: 'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24; }
        .ms-fill { font-variation-settings: 'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24; }
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-brand-900 via-brand-800 to-indigo-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center mx-auto mb-4">
                <span class="ms ms-fill text-white text-3xl">school</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">MetaAgenda</h1>
            <p class="text-brand-200 text-sm mt-1 font-medium">Acesso do Professor</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm font-medium mb-6">
                <span class="ms ms-fill text-red-500">error</span>
                {{ session('error') }}
            </div>
            @endif

            <h2 class="text-xl font-bold text-slate-800 mb-1">Consultar Horários</h2>
            <p class="text-sm text-slate-500 mb-6">Informe seu CPF para acessar sua grade de aulas.</p>

            <form method="POST" action="{{ route('professor.buscar') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">CPF</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 ms text-slate-400">badge</span>
                        <input
                            type="text"
                            name="cpf"
                            required
                            maxlength="11"
                            placeholder="Somente números"
                            class="w-full pl-12 pr-4 py-3.5 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent"
                        >
                    </div>
                    @error('cpf')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="w-full bg-brand-900 hover:bg-brand-800 text-white font-bold py-3.5 rounded-xl transition-colors flex items-center justify-center gap-2">
                    <span class="ms">arrow_forward</span> Acessar Horários
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <a href="{{ route('aluno.consulta') }}" class="text-xs text-brand-600 font-semibold hover:underline flex items-center justify-center gap-1">
                    <span class="ms text-sm">school</span> Sou aluno
                </a>
            </div>
        </div>

        <p class="text-center text-brand-300 text-xs mt-6">MetaAgenda · Sistema Acadêmico</p>
    </div>
</body>
</html>
