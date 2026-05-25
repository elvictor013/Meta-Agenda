<!-- tela admin -->
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

        body {
            font-family: 'Manrope', sans-serif;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background text-on-background min-h-screen pb-24">
  @yield('content')
</body>

</html>