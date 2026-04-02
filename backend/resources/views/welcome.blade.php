<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Colegio Olga M. de Aredez — Sistema de Gestión</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Public+Sans:wght@100..900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-primary-fixed-variant": "#5c5b5b",
                        "surface-dim": "#d1dce0",
                        "primary": "#5f5e5e",
                        "tertiary-container": "#a7c5fb",
                        "on-background": "#2b3437",
                        "error": "#9f403d",
                        "outline": "#737c7f",
                        "inverse-on-surface": "#9b9d9e",
                        "surface-container-low": "#f1f4f6",
                        "on-tertiary": "#f8f8ff",
                        "on-secondary": "#fff7f6",
                        "outline-variant": "#abb3b7",
                        "primary-fixed-dim": "#d6d4d3",
                        "on-primary": "#faf7f6",
                        "on-secondary-fixed": "#76202c",
                        "surface-container-highest": "#dbe4e7",
                        "inverse-primary": "#ffffff",
                        "secondary-fixed": "#ffdada",
                        "surface-container": "#eaeff1",
                        "on-tertiary-fixed": "#022956",
                        "on-primary-container": "#525151",
                        "on-tertiary-fixed-variant": "#294776",
                        "inverse-surface": "#0c0f10",
                        "surface-tint": "#5f5e5e",
                        "on-error": "#fff7f6",
                        "error-dim": "#4e0309",
                        "error-container": "#fe8983",
                        "primary-dim": "#535252",
                        "tertiary-fixed-dim": "#9ab7ec",
                        "on-primary-fixed": "#403f3f",
                        "secondary-fixed-dim": "#ffc6c8",
                        "primary-container": "#e5e2e1",
                        "surface": "#f8f9fa",
                        "on-secondary-container": "#8e323d",
                        "secondary-container": "#ffdada",
                        "surface-variant": "#dbe4e7",
                        "on-error-container": "#752121",
                        "secondary-dim": "#90333e",
                        "background": "#f8f9fa",
                        "surface-bright": "#f8f9fa",
                        "tertiary": "#425f8f",
                        "secondary": "#9f3f49",
                        "tertiary-dim": "#365382",
                        "on-tertiary-container": "#1f3e6c",
                        "surface-container-high": "#e3e9ec",
                        "on-secondary-fixed-variant": "#9b3c46",
                        "on-surface-variant": "#586064",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#e5e2e1",
                        "on-surface": "#2b3437"
                    },
                    fontFamily: {
                        "headline": ["Newsreader"],
                        "body": ["Public Sans"],
                        "label": ["Public Sans"]
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }
        .font-serif { font-family: 'Newsreader', serif; }
        .font-sans  { font-family: 'Public Sans', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface font-body selection:bg-secondary/20">

    {{-- Top Navigation Bar --}}
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl shadow-[0_20px_40px_rgba(43,52,55,0.05)] transition-all duration-300">
        <div class="flex justify-between items-center h-20 px-6 md:px-12 max-w-screen-2xl mx-auto">
            <div class="flex items-center gap-4">
                <img src="{{ asset('logo_olga_aredez.jpeg') }}" alt="Escudo Colegio Olga M. de Aredez" class="h-12 w-auto"/>
                <span class="text-lg font-serif font-bold text-zinc-900 tracking-wide">Colegio Olga M. de Aredez</span>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/administracion') }}"
                       class="px-6 py-2.5 bg-on-surface text-surface rounded-md font-sans text-sm font-semibold active:scale-[0.98] transition-transform">
                        Panel
                    </a>
                @else
                    <a href="{{ route('filament.administracion.auth.login') }}"
                       class="px-6 py-2.5 bg-on-surface text-surface rounded-md font-sans text-sm font-semibold active:scale-[0.98] transition-transform">
                        Acceder
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-20">

        {{-- Hero Section --}}
        <section class="relative min-h-[921px] flex items-center overflow-hidden bg-surface-container-low">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-gradient-to-br from-primary to-transparent rounded-full blur-[120px] -mr-48 -mt-48"></div>
                <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-gradient-to-tr from-secondary to-transparent rounded-full blur-[100px] -ml-24 -mb-24"></div>
            </div>
            <div class="container mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
                <div class="space-y-8">
                    <h1 class="text-5xl md:text-7xl font-serif text-on-surface leading-[1.1] tracking-tight">
                        Bienvenidos al Portal de la <span class="italic text-secondary">Excelencia</span> Educativa
                    </h1>
                    <p class="text-xl text-on-surface-variant font-sans max-w-lg leading-relaxed">
                        Nuestra institución se enorgullece de su programa para <span class="font-bold">Jóvenes y Adultos</span>,
                        brindando oportunidades de crecimiento intelectual bajo un marco de rigor académico y calidez humana.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('filament.administracion.auth.login') }}"
                           class="px-8 py-4 bg-on-surface text-surface rounded-md font-sans font-bold flex items-center justify-center gap-2 hover:bg-on-surface/90 transition-all active:scale-[0.98]">
                            Acceder al Sistema
                            <span class="material-symbols-outlined text-lg">login</span>
                        </a>
                    </div>
                </div>
                <div class="relative group">
                    <div class="absolute -inset-4 bg-on-surface/5 rounded-xl blur-2xl group-hover:bg-on-surface/10 transition-all duration-700"></div>
                    <div class="relative aspect-[4/5] bg-surface-container-lowest overflow-hidden rounded-lg shadow-[0_20px_40px_rgba(43,52,55,0.05)] border border-outline-variant/10">
                        <img src="{{ asset('foto-fondo-olga-aredez.png') }}" alt="Instalaciones del colegio" class="w-full h-full object-cover"/>
                        <div class="absolute bottom-0 left-0 right-0 m-8 p-6 bg-white/90 backdrop-blur-md border-l-4 border-secondary">
                            <p class="font-serif italic text-lg text-on-surface">"La educación no es preparación para la vida; la educación es la vida misma."</p>
                            <p class="font-sans text-xs uppercase tracking-widest mt-2 text-primary">Ideario Institucional</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

    {{-- Footer --}}
    <footer class="w-full py-16 border-t border-zinc-200/50 bg-zinc-50">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center px-8 gap-6">
            <div class="flex flex-col items-center md:items-start gap-4">
                <span class="text-sm font-serif italic text-zinc-400">Colegio Olga M. de Aredez</span>
                <p class="text-zinc-500 font-sans text-xs uppercase tracking-widest text-center md:text-left">
                    &copy; {{ date('Y') }} Colegio Secundario 'Olga M. de Aredez'. La Excelencia en el Corazón de la Educación.
                </p>
            </div>

        </div>
    </footer>

</body>
</html>