<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MetaAgenda — @yield('title', 'Sistema Acadêmico')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50:'#eef2ff', 100:'#e0e7ff', 200:'#c7d2fe', 300:'#a5b4fc', 400:'#818cf8', 500:'#6366f1', 600:'#4f46e5', 700:'#4338ca', 800:'#3730a3', 900:'#1e1b4b', 950:'#0f0e2e' },
                        amber: { 400:'#fbbf24', 500:'#f59e0b' },
                        slate: { 50:'#f8fafc', 100:'#f1f5f9', 200:'#e2e8f0', 300:'#cbd5e1', 400:'#94a3b8', 500:'#64748b', 600:'#475569', 700:'#334155', 800:'#1e293b', 900:'#0f172a', 950:'#020617' },
                    },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'], mono: ['DM Mono', 'monospace'] },
                }
            }
        }
    </script>
    <style>
        .ms { font-family: 'Material Symbols Rounded'; font-variation-settings: 'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24; }
        .ms-fill { font-variation-settings: 'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24; }
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        .sidebar-link.active { background: #eef2ff; color: #4338ca; font-weight: 700; }
        .sidebar-link.active .ms { color: #4338ca; }
        input, select, textarea { font-family: 'Plus Jakarta Sans', sans-serif !important; }
        .modal-overlay { backdrop-filter: blur(4px); }
        @keyframes fadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
        .animate-in { animation: fadeIn .25s ease forwards; }
        @keyframes slideIn { from{opacity:0;transform:scale(.96)} to{opacity:1;transform:scale(1)} }
        .modal-box { animation: slideIn .2s ease forwards; }
    </style>
    @yield('head')
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex">

{{-- SIDEBAR --}}
<aside class="w-64 min-h-screen bg-white border-r border-slate-200 flex flex-col fixed top-0 left-0 z-20 shadow-sm" id="sidebar">
    {{-- Logo --}}
    <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-100">
        <div class="w-8 h-8 rounded-lg bg-brand-900 flex items-center justify-center">
            <span class="ms text-white text-sm ms-fill">school</span>
        </div>
        <div>
            <span class="font-extrabold text-brand-900 text-base tracking-tight">MetaAgenda</span>
            <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-widest -mt-0.5">@yield('sidebar-role', 'Sistema')</p>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 py-4 px-3 space-y-0.5 overflow-y-auto">
        @yield('sidebar-nav')
    </nav>

    {{-- User --}}
    <div class="border-t border-slate-100 p-4">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-brand-900 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                {{ strtoupper(substr(auth()->user()->name ?? 'Usuário', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800 truncate">@yield('user-name', 'Usuário')</p>
                <p class="text-xs text-slate-400 truncate">@yield('user-role', '')</p>
            </div>
            @yield('sidebar-logout')
        </div>
    </div>
</aside>

{{-- MAIN --}}
<div class="flex-1 ml-64 flex flex-col min-h-screen">
    {{-- Top bar --}}
    <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-10">
        <div>
            <h1 class="font-bold text-slate-900 text-lg">@yield('page-title', '')</h1>
            <p class="text-xs text-slate-400">@yield('page-subtitle', '')</p>
        </div>
        <div class="flex items-center gap-3">
            @yield('header-actions')
        </div>
    </header>

    {{-- Alerts --}}
    <div class="px-8 pt-4">
        @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm font-medium mb-4 animate-in">
            <span class="ms ms-fill text-emerald-500">check_circle</span>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm font-medium mb-4 animate-in">
            <span class="ms ms-fill text-red-500">error</span>
            {{ session('error') }}
        </div>
        @endif
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm font-medium mb-4 animate-in">
            <div class="flex items-center gap-2 mb-1"><span class="ms ms-fill text-red-500">error</span><strong>Erros encontrados:</strong></div>
            <ul class="list-disc list-inside space-y-0.5 ml-6">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
        @endif
    </div>

    {{-- Content --}}
    <main class="flex-1 px-8 pb-12">
        @yield('content')
    </main>
</div>

@yield('modals')
@yield('scripts')
</body>
</html>
