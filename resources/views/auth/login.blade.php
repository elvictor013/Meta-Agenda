<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
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
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
    <main class="flex-grow flex items-center justify-center px-gutter py-xl bg-slate-50">
        <div class="w-full max-w-md">
            <div class="text-center mb-xl">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-container rounded-2xl mb-lg shadow-lg">
                    <span class="material-symbols-outlined text-white text-4xl" data-icon="school">school</span>
                </div>
                <h1 class="font-h1 text-h1 text-primary-container tracking-tighter mb-xs">MetaAgenda</h1>
                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest">Portal de Coordenação</p>
            </div>
            <div class="bg-surface-container-lowest p-xl rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-outline-variant/30">
                <div class="mb-lg">
                    <h2 class="font-h3 text-h3 text-on-surface mb-2">Bem-vindo</h2>
                    <p class="font-body-md text-on-surface-variant">Acesse sua conta para gerenciar alocações e turmas.</p>
                </div>
                <form method="POST" action="{{ route('login.process') }}" class="space-y-md">
                    @csrf

                    <!-- CPF -->
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant ml-1" for="cpf">CPF</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-xl">badge</span>
                            <input
                                class="w-full pl-12 pr-4 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-md transition-all"
                                id="cpf"
                                name="cpf"
                                type="text"
                                value="{{ old('cpf') }}"
                                placeholder="000.000.000-00" />
                        </div>

                        @error('cpf')
                        <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- SENHA -->
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant ml-1" for="password">Senha</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-xl">lock</span>
                            <input
                                class="w-full pl-12 pr-12 py-3 bg-surface-container-low border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-body-md transition-all"
                                id="password"
                                name="password"
                                type="password"
                                placeholder="••••••••" />
                        </div>

                        @error('password')
                        <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- ERRO GERAL -->
                    @if(session('error'))
                    <div class="text-red-500 text-sm">
                        {{ session('error') }}
                    </div>
                    @endif

                    <!-- BOTÃO -->
                    <button
                        class="w-full bg-primary-container text-white font-button text-button py-4 rounded-lg shadow-sm hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-2 mt-sm"
                        type="submit">
                        <span>Entrar</span>
                        <span class="material-symbols-outlined text-lg">login</span>
                    </button>
                </form>
                <div class="mt-xl pt-lg border-t border-outline-variant/30 text-center">
                    <p class="font-label-sm text-label-sm text-on-surface-variant">
                        <a class="text-primary font-bold hover:underline" href="/">Dashboard</a>
                    </p>
                </div>
            </div>
            <div class="mt-lg flex justify-center items-center gap-4 text-outline opacity-60">
                <div class="h-[1px] w-8 bg-outline"></div>
                <p class="font-label-sm text-[10px] uppercase tracking-[0.2em]">Ambiente Seguro SSL</p>
                <div class="h-[1px] w-8 bg-outline"></div>
            </div>
        </div>
    </main>
    <footer class="py-lg px-gutter text-center">
        <p class="font-label-sm text-label-sm text-on-surface-variant">
            © 2024 MetaAgenda Institutional. Todos os direitos reservados.
        </p>
    </footer>
    <div class="fixed top-0 left-0 w-full h-1 bg-gradient-to-r from-primary via-secondary to-primary-container"></div>
    <div class="hidden md:block absolute top-0 right-0 w-1/3 h-full overflow-hidden z-[-1] opacity-20">
        <div class="w-full h-full bg-surface-container-high" style="clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 0% 100%);">
            <div class="w-full h-full bg-cover bg-center grayscale mix-blend-multiply" data-alt="A sophisticated close-up of a modern university architectural detail with sharp glass angles and concrete textures. The lighting is bright and airy, suggesting a clean, professional academic atmosphere. The color palette is dominated by soft whites and cool grays with deep blue shadows, reflecting a high-end corporate research institution aesthetic." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAjRtEYyeP7IGcr8yaFoKi8ZLi4runRmytIV25yKrqrDtBFAkx18RvMiPm7xQ3kPM9fPP5Vgi504zDL7uxExAWSWcqRf4I5olBTA2PBzKgkg-Vwfz71aR-J2dPOw8-Z2dN7-VaLMkEfGTHgaqIGI4qAaXppqO5vfgT0SzX4AJ4IkQ75K9LN0ybjtNliZRkpAsBMOEsEW8CtGXecdvzjGqqxD_t0WGszgcwEe5L36WeJrEYVIczMDsvE1Tnao6IzG6bo8gtylEcSfg')">
            </div>
        </div>
    </div>
</body>

</html>