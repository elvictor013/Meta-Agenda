<!DOCTYPE html>

<html class="light" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MetaAgenda - Painel Administrativo</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container": "#f0edf2",
                        "secondary-fixed": "#ffdf93",
                        "inverse-on-surface": "#f3eff4",
                        "surface-tint": "#575a8d",
                        "on-surface": "#1b1b1f",
                        "on-tertiary-fixed": "#311300",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed-variant": "#673c1f",
                        "on-secondary-container": "#745a00",
                        "tertiary": "#120400",
                        "surface-container-highest": "#e5e1e6",
                        "surface-container-high": "#eae7ec",
                        "secondary-fixed-dim": "#edc14a",
                        "on-secondary-fixed-variant": "#594400",
                        "on-primary": "#ffffff",
                        "on-surface-variant": "#46464f",
                        "on-background": "#1b1b1f",
                        "tertiary-fixed-dim": "#f7b993",
                        "outline": "#777680",
                        "primary-fixed-dim": "#bfc2fc",
                        "on-tertiary-container": "#b17b59",
                        "on-primary-fixed-variant": "#3f4274",
                        "primary-fixed": "#e0e0ff",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#8083b9",
                        "on-error-container": "#93000a",
                        "primary-container": "#171a4a",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed": "#131546",
                        "inverse-surface": "#303034",
                        "surface-container-lowest": "#ffffff",
                        "secondary-container": "#ffd259",
                        "background": "#fcf8fd",
                        "error": "#ba1a1a",
                        "tertiary-container": "#381600",
                        "secondary": "#765b00",
                        "surface-dim": "#dcd9de",
                        "outline-variant": "#c7c5d0",
                        "surface": "#fcf8fd",
                        "tertiary-fixed": "#ffdbc7",
                        "surface-bright": "#fcf8fd",
                        "error-container": "#ffdad6",
                        "surface-variant": "#e5e1e6",
                        "primary": "#000032",
                        "surface-container-low": "#f6f2f7",
                        "on-secondary-fixed": "#241a00",
                        "inverse-primary": "#bfc2fc"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xs": "0.25rem",
                        "md": "1rem",
                        "lg": "1.5rem",
                        "xl": "3rem",
                        "container_max_width": "1320px",
                        "sm": "0.5rem",
                        "gutter": "1.5rem",
                        "base": "8px"
                    },
                    "fontFamily": {
                        "h2": ["Manrope"],
                        "h1": ["Manrope"],
                        "label-sm": ["Manrope"],
                        "h3": ["Manrope"],
                        "button": ["Manrope"],
                        "body-md": ["Manrope"],
                        "body-lg": ["Manrope"]
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
                        "label-sm": ["0.875rem", {
                            "lineHeight": "1.4",
                            "letterSpacing": "0.02em",
                            "fontWeight": "500"
                        }],
                        "h3": ["1.75rem", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "button": ["1rem", {
                            "lineHeight": "1",
                            "letterSpacing": "0.01em",
                            "fontWeight": "600"
                        }],
                        "body-md": ["1rem", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "body-lg": ["1.125rem", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        body {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>

<body class="bg-background text-on-background min-h-screen flex flex-col overflow-x-hidden">
    @yield('content')
</body>


</html>