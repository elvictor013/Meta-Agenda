<!DOCTYPE html>

<html class="light" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed-dim": "#f7b993",
                        "tertiary-container": "#381600",
                        "surface-variant": "#e5e1e6",
                        "on-error-container": "#93000a",
                        "on-secondary-container": "#745a00",
                        "on-primary-fixed-variant": "#3f4274",
                        "on-secondary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed-dim": "#edc14a",
                        "inverse-surface": "#303034",
                        "primary-fixed-dim": "#bfc2fc",
                        "on-tertiary-fixed": "#311300",
                        "surface-dim": "#dcd9de",
                        "on-surface": "#1b1b1f",
                        "surface-container-high": "#eae7ec",
                        "secondary-container": "#ffd259",
                        "primary-fixed": "#e0e0ff",
                        "surface-container": "#f0edf2",
                        "primary": "#000032",
                        "on-primary-container": "#8083b9",
                        "error-container": "#ffdad6",
                        "surface-container-highest": "#e5e1e6",
                        "on-tertiary-container": "#b17b59",
                        "on-primary-fixed": "#131546",
                        "error": "#ba1a1a",
                        "surface-container-low": "#f6f2f7",
                        "on-secondary-fixed-variant": "#594400",
                        "tertiary": "#120400",
                        "secondary-fixed": "#ffdf93",
                        "primary-container": "#171a4a",
                        "background": "#fcf8fd",
                        "outline-variant": "#c7c5d0",
                        "outline": "#777680",
                        "inverse-primary": "#bfc2fc",
                        "on-background": "#1b1b1f",
                        "on-secondary-fixed": "#241a00",
                        "on-primary": "#ffffff",
                        "on-error": "#ffffff",
                        "surface-bright": "#fcf8fd",
                        "surface": "#fcf8fd",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#46464f",
                        "surface-tint": "#575a8d",
                        "inverse-on-surface": "#f3eff4",
                        "secondary": "#765b00",
                        "on-tertiary-fixed-variant": "#673c1f",
                        "tertiary-fixed": "#ffdbc7"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xs": "0.25rem",
                        "base": "8px",
                        "xl": "3rem",
                        "container_max_width": "1320px",
                        "sm": "0.5rem",
                        "md": "1rem",
                        "lg": "1.5rem",
                        "gutter": "1.5rem"
                    },
                    "fontFamily": {
                        "h2": ["Manrope"],
                        "h1": ["Manrope"],
                        "button": ["Manrope"],
                        "body-lg": ["Manrope"],
                        "body-md": ["Manrope"],
                        "h3": ["Manrope"],
                        "label-sm": ["Manrope"]
                    },
                    "fontSize": {
                        "h2": ["2rem", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "h1": ["2.5rem", {
                            "lineHeight": "1.2",
                            "fontWeight": "700"
                        }],
                        "button": ["1rem", {
                            "lineHeight": "1",
                            "letterSpacing": "0.01em",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["1.125rem", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "body-md": ["1rem", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "h3": ["1.75rem", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "label-sm": ["0.875rem", {
                            "lineHeight": "1.4",
                            "letterSpacing": "0.02em",
                            "fontWeight": "500"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #fcf8fd;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background min-h-screen flex flex-col items-center justify-center p-md">
    <!-- TopAppBar - Brand Anchor -->
    <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 h-16 bg-white dark:bg-slate-950 border-b border-gray-200 dark:border-gray-800 shadow-sm">
        <div class="flex items-center gap-xs">
            <span class="material-symbols-outlined text-[#171a4a] text-xl" data-icon="school">school</span>
            <div class="flex flex-col">
                <span class="text-xl font-extrabold text-[#171a4a] dark:text-blue-200 tracking-wider">MetaAgenda</span>
                <span class="text-[10px] font-medium uppercase tracking-widest text-outline">Consulta Acadêmica</span>
            </div>
        </div>
    </header>
    <main class="w-full max-w-[400px] mt-20 flex flex-col items-center">
        <!-- Hero Decorative Element -->
        <div class="w-24 h-24 mb-lg rounded-full bg-primary-container flex items-center justify-center shadow-lg">
            <span class="material-symbols-outlined text-white text-4xl" data-icon="account_circle" style="font-variation-settings: 'FILL' 1;">account_circle</span>
        </div>

        <!-- Central Access Card -->
        <div class="w-full bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <div class="text-center mb-lg">
                <h1 class="font-h2 text-h2 text-on-surface mb-xs">Acesso do Aluno</h1>
                <p class="font-body-md text-on-surface-variant text-sm">Insira suas credenciais institucionais para visualizar sua agenda acadêmica.</p>
            </div>
            <x-alert/>
            <form class="space-y-lg" method="POST" action="{{ route('aluno.buscar') }}">
                @csrf
                <div class="space-y-xs">
                    <label class="font-label-sm text-label-sm text-on-surface-variant px-xs" for="matricula">Matrícula</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline" data-icon="badge">badge</span>
                        <input class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg font-body-md focus:outline-none focus:ring-2 focus:ring-primary-container/20 focus:border-primary-container transition-all placeholder:text-outline/50" name="matricula" id="matricula" placeholder="Digite sua matrícula" type="text" />
                    </div>
                </div>
                <button
                    class="w-full h-14 bg-primary-container text-white font-button text-button rounded-lg shadow-sm hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-sm"
                    type="submit">
                    Acessar
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </form>
            <div class="mt-lg pt-lg border-t border-surface-variant flex flex-col items-center gap-md">
                <a class="font-label-sm text-primary-container font-bold hover:underline underline-offset-4 flex items-center gap-xs" href="{{ route('login.coordenador') }}">
                    <span class="material-symbols-outlined text-[18px]" data-icon="admin_panel_settings">admin_panel_settings</span>
                    Sou coordenador
                </a>
            </div>
            
        </div>
        <!-- Support Info -->
        <footer class="mt-xl text-center">
            <p class="font-body-md text-[12px] text-outline px-lg">
                Precisa de ajuda com seu acesso? Entre em contato com a secretaria acadêmica de sua unidade.
            </p>
        </footer>
    </main>
    <!-- Visual Background Element -->
    <div class="fixed -bottom-20 -left-20 w-64 h-64 bg-primary-container/5 rounded-full blur-3xl -z-10"></div>
    <div class="fixed -top-20 -right-20 w-80 h-80 bg-secondary-container/10 rounded-full blur-3xl -z-10"></div>
    <!-- Background Context Image for Theme Integrity -->
    <div class="hidden">
        <img data-alt="A striking digital installation art piece featuring glowing, generative geometric shapes suspended in a vast, minimalist gallery space. The room is illuminated by high-key, soft white lighting that creates a bright, modern light-mode aesthetic. The artwork relies on a sophisticated palette of deep navy blues and pristine whites, punctuated by intense accents of scholarly gold. The mood is serene yet technologically advanced." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_xle_fenCMabWpBeziJ7WH45_rzcOAAYK3APYccffAVRhN6TQc4e6RM9z8r0TptxC656fiGGU_SjZST6tjvDTccrEuDy5_yPtvpU2dG5DE2pys9ootDsAVFSNv5rv-1EeshY306UIKaQTNVPlCaI0_QDYexUJFYeIG_3AKNiifATHeIYfQ4yS8B0kx8L0B5oHz3Hum-ReOPRvJrzfAzy90RX5MtKu15mLedvtu63btEfFsiUMN7Fskupb66am6WN0OAeK6UKaiw" />
    </div>
</body>

</html>