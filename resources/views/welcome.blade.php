<!DOCTYPE html>

<html class="light" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MetaAgenda - Gestão Acadêmica</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-container": "#381600",
                        "surface-dim": "#dcd9de",
                        "surface-tint": "#575a8d",
                        "surface-container-high": "#eae7ec",
                        "on-secondary-container": "#745a00",
                        "on-primary-fixed": "#131546",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#c7c5d0",
                        "surface-bright": "#fcf8fd",
                        "primary": "#000032",
                        "tertiary-fixed-dim": "#f7b993",
                        "tertiary": "#120400",
                        "on-tertiary-container": "#b17b59",
                        "on-secondary-fixed-variant": "#594400",
                        "error": "#ba1a1a",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed": "#241a00",
                        "surface-variant": "#e5e1e6",
                        "surface-container-highest": "#e5e1e6",
                        "outline": "#777680",
                        "surface-container-lowest": "#ffffff",
                        "primary-container": "#171a4a",
                        "surface-container": "#f0edf2",
                        "surface": "#fcf8fd",
                        "primary-fixed-dim": "#bfc2fc",
                        "on-surface": "#1b1b1f",
                        "background": "#fcf8fd",
                        "tertiary-fixed": "#ffdbc7",
                        "secondary-container": "#ffd259",
                        "on-primary-fixed-variant": "#3f4274",
                        "secondary-fixed-dim": "#edc14a",
                        "on-background": "#1b1b1f",
                        "on-primary-container": "#8083b9",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "on-surface-variant": "#46464f",
                        "secondary-fixed": "#ffdf93",
                        "on-tertiary-fixed": "#311300",
                        "surface-container-low": "#f6f2f7",
                        "inverse-surface": "#303034",
                        "secondary": "#765b00",
                        "primary-fixed": "#e0e0ff",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed-variant": "#673c1f",
                        "inverse-on-surface": "#f3eff4",
                        "inverse-primary": "#bfc2fc"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "3rem",
                        "xs": "0.25rem",
                        "sm": "0.5rem",
                        "md": "1rem",
                        "container_max_width": "1320px",
                        "gutter": "1.5rem",
                        "base": "8px",
                        "lg": "1.5rem"
                    },
                    "fontFamily": {
                        "label-sm": ["Manrope"],
                        "body-lg": ["Manrope"],
                        "h3": ["Manrope"],
                        "h2": ["Manrope"],
                        "body-md": ["Manrope"],
                        "button": ["Manrope"],
                        "h1": ["Manrope"]
                    },
                    "fontSize": {
                        "label-sm": ["0.875rem", {
                            "lineHeight": "1.4",
                            "letterSpacing": "0.02em",
                            "fontWeight": "500"
                        }],
                        "body-lg": ["1.125rem", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "h3": ["1.75rem", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "h2": ["2rem", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "body-md": ["1rem", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "button": ["1rem", {
                            "lineHeight": "1",
                            "letterSpacing": "0.01em",
                            "fontWeight": "600"
                        }],
                        "h1": ["2.5rem", {
                            "lineHeight": "1.2",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .bg-mesh {
            background-color: #fcf8fd;
            background-image: radial-gradient(at 0% 0%, rgba(23, 26, 74, 0.03) 0, transparent 50%),
                radial-gradient(at 50% 0%, rgba(219, 177, 59, 0.05) 0, transparent 50%);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-mesh font-body-md text-on-surface min-h-screen flex flex-col items-center justify-center p-md">
    <header class="fixed top-0 z-50 w-full bg-white dark:bg-slate-950 flex justify-between items-center px-4 h-16 shadow-sm border-b border-slate-200 dark:border-slate-800">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[#171a4a] dark:text-white" data-icon="school">school</span>
            <h1 class="font-manrope text-[#171a4a] dark:text-white font-black text-xl tracking-tighter">MetaAgenda</h1>
        </div>
        <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden flex items-center justify-center">
            <span class="material-symbols-outlined text-slate-500 text-sm" data-icon="person">person</span>
        </div>
    </header>

    <main class="max-w-container_max_width w-full flex flex-col items-center gap-xl mt-16 pb-24">
        <section class="text-center space-y-md max-w-2xl px-gutter">
            <h2 class="font-h1 text-h1 text-primary-container tracking-tight">Bem-vindo ao Futuro da <span class="text-secondary">Gestão Acadêmica</span></h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Selecione seu perfil de acesso para gerenciar horários, alocações e turmas com eficiência e clareza.</p>
        </section>

        <!-- 3-column grid for the three access cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg w-full max-w-5xl px-gutter">

            <!-- Aluno -->
            <a href="{{ route('aluno.consulta') }}"
                class="group relative bg-white border border-slate-200 rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center text-center gap-md border-b-4 border-b-[#171a4a] active:scale-95">

                <div class="w-20 h-20 rounded-full bg-primary-container flex items-center justify-center text-white mb-2 shadow-lg group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-4xl">person_search</span>
                </div>

                <h3 class="font-h3 text-h3 text-primary-container">Sou Aluno</h3>

                <p class="font-label-sm text-label-sm text-on-surface-variant">
                    Consulte seus horários, frequências e materiais didáticos de forma rápida.
                </p>

                <div class="mt-auto pt-md px-6 py-3 bg-[#171a4a] text-white rounded-lg font-button text-button shadow-sm hover:opacity-90">
                    Ver Cronograma
                </div>
            </a>

            <!-- Professor -->
            <a href="#"
                class="group relative bg-white border border-slate-200 rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center text-center gap-md border-b-4 border-b-[#2e7d32] active:scale-95">

                <div class="w-20 h-20 rounded-full flex items-center justify-center mb-2 shadow-lg group-hover:scale-110 transition-transform" style="background-color: #2e7d32;">
                    <span class="material-symbols-outlined text-4xl text-white">cast_for_education</span>
                </div>

                <h3 class="font-h3 text-h3 text-primary-container">Sou Professor</h3>

                <p class="font-label-sm text-label-sm text-on-surface-variant">
                    Visualize seu cronograma semanal, turmas e disciplinas atribuídas.
                </p>

                <div class="mt-auto pt-md px-6 py-3 text-white rounded-lg font-button text-button shadow-sm hover:opacity-90" style="background-color: #2e7d32;">
                    Ver Cronograma
                </div>
            </a>

            <!-- Coordenação -->
            <a href="{{ route('login.coordenador') }}"
                class="group relative bg-white border border-slate-200 rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center text-center gap-md border-b-4 border-b-secondary-fixed-dim active:scale-95">

                <div class="w-20 h-20 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container mb-2 shadow-lg group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-4xl">admin_panel_settings</span>
                </div>

                <h3 class="font-h3 text-h3 text-primary-container">Sou Coordenação</h3>

                <p class="font-label-sm text-label-sm text-on-surface-variant">
                    Gerencie alocações de professores, criação de turmas e relatórios estratégicos.
                </p>

                <div class="mt-auto pt-md px-6 py-3 bg-[#171a4a] text-white rounded-lg font-button text-button shadow-sm hover:opacity-90">
                    Painel de Gestão
                </div>
            </a>

        </div>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-md w-full max-w-5xl px-gutter mt-lg">
            <div class="bg-surface-container-low p-md rounded-lg flex items-start gap-sm">
                <span class="material-symbols-outlined text-secondary" data-icon="calendar_month">calendar_month</span>
                <div>
                    <span class="font-label-sm font-bold block">Agendas Inteligentes</span>
                    <span class="text-xs text-on-surface-variant">Conflitos resolvidos automaticamente.</span>
                </div>
            </div>
            <div class="bg-surface-container-low p-md rounded-lg flex items-start gap-sm">
                <span class="material-symbols-outlined text-secondary" data-icon="analytics">analytics</span>
                <div>
                    <span class="font-label-sm font-bold block">Relatórios em Tempo Real</span>
                    <span class="text-xs text-on-surface-variant">Dados precisos para tomada de decisão.</span>
                </div>
            </div>
            <div class="bg-surface-container-low p-md rounded-lg flex items-start gap-sm">
                <span class="material-symbols-outlined text-secondary" data-icon="cloud_done">cloud_done</span>
                <div>
                    <span class="font-label-sm font-bold block">Sincronização Total</span>
                    <span class="text-xs text-on-surface-variant">Acesse de qualquer dispositivo.</span>
                </div>
            </div>
        </section>
    </main>

    <!-- Bottom nav mobile -->
    <div class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 py-2 pb-safe bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 shadow-[0_-2px_10px_rgba(0,0,0,0.05)] md:hidden">
        <div class="flex flex-col items-center justify-center text-[#171a4a] dark:text-[#dbb13b] bg-slate-100 dark:bg-slate-800 rounded-xl px-3 py-1">
            <span class="material-symbols-outlined" data-icon="home">home</span>
            <span class="font-manrope text-[11px] font-medium">Início</span>
        </div>
        <div class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
            <span class="material-symbols-outlined" data-icon="calendar_add_on">calendar_add_on</span>
            <span class="font-manrope text-[11px] font-medium">Alocação</span>
        </div>
        <div class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
            <span class="material-symbols-outlined" data-icon="groups">groups</span>
            <span class="font-manrope text-[11px] font-medium">Turmas</span>
        </div>
        <div class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
            <span class="material-symbols-outlined" data-icon="person">person</span>
            <span class="font-manrope text-[11px] font-medium">Perfil</span>
        </div>
    </div>
</body>

</html>