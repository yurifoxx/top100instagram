<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <title>{{ $seo['title'] ?? 'Top 100 Instagram Brasil' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Ranking dos 100 perfis do Instagram com mais seguidores no Brasil.' }}">
    @if(isset($seo['canonical']))
    <link rel="canonical" href="{{ $seo['canonical'] }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
    <meta property="og:title" content="{{ $seo['title'] ?? 'Top 100 Instagram Brasil' }}">
    <meta property="og:description" content="{{ $seo['description'] ?? 'Ranking dos 100 perfis do Instagram com mais seguidores no Brasil.' }}">
    <meta property="og:url" content="{{ $seo['canonical'] ?? url()->current() }}">
    <meta property="og:image" content="{{ $seo['image'] ?? asset('img/og-default.jpg') }}">
    <meta property="og:site_name" content="Top 100 Instagram Brasil">
    <meta property="og:locale" content="pt_BR">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] ?? 'Top 100 Instagram Brasil' }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? 'Ranking dos 100 perfis do Instagram com mais seguidores no Brasil.' }}">
    <meta name="twitter:image" content="{{ $seo['image'] ?? asset('img/og-default.jpg') }}">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        instagram: {
                            purple: '#833AB4',
                            pink:   '#E1306C',
                            orange: '#F77737',
                        }
                    }
                }
            }
        }
    </script>

    {{-- Alpine.js CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('head')
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                    📸 Top 100 Brasil
                </span>
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-purple-600 transition-colors">Ranking</a>
                <a href="{{ route('category.show', 'atleta') }}" class="hover:text-purple-600 transition-colors">Atletas</a>
                <a href="{{ route('category.show', 'musico') }}" class="hover:text-purple-600 transition-colors">Músicos</a>
                <a href="{{ route('category.show', 'influencer') }}" class="hover:text-purple-600 transition-colors">Influencers</a>
                <a href="{{ route('about') }}" class="hover:text-purple-600 transition-colors">Sobre</a>
            </nav>
            {{-- Mobile menu --}}
            <button x-data x-on:click="$dispatch('toggle-menu')" class="md:hidden text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        {{-- Mobile nav --}}
        <div x-data="{ open: false }" x-on:toggle-menu.window="open = !open" x-show="open" class="md:hidden bg-white border-t px-4 py-3 space-y-2 text-sm font-medium">
            <a href="{{ route('home') }}" class="block py-1 text-gray-700 hover:text-purple-600">Ranking</a>
            <a href="{{ route('category.show', 'atleta') }}" class="block py-1 text-gray-700 hover:text-purple-600">Atletas</a>
            <a href="{{ route('category.show', 'musico') }}" class="block py-1 text-gray-700 hover:text-purple-600">Músicos</a>
            <a href="{{ route('category.show', 'influencer') }}" class="block py-1 text-gray-700 hover:text-purple-600">Influencers</a>
            <a href="{{ route('about') }}" class="block py-1 text-gray-700 hover:text-purple-600">Sobre</a>
        </div>
    </header>

    {{-- Main --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 mt-16">
        <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-white font-bold text-lg mb-2">📸 Top 100 Instagram Brasil</h3>
                <p class="text-sm leading-relaxed">O ranking mais completo dos perfis do Instagram com mais seguidores no Brasil. Atualizado diariamente.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Categorias</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('category.show', 'atleta') }}" class="hover:text-white transition-colors">⚽ Atletas</a></li>
                    <li><a href="{{ route('category.show', 'musico') }}" class="hover:text-white transition-colors">🎵 Músicos</a></li>
                    <li><a href="{{ route('category.show', 'ator') }}" class="hover:text-white transition-colors">🎬 Atores/Atrizes</a></li>
                    <li><a href="{{ route('category.show', 'influencer') }}" class="hover:text-white transition-colors">📱 Influencers</a></li>
                    <li><a href="{{ route('category.show', 'humorista') }}" class="hover:text-white transition-colors">😂 Humoristas</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Links</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Ranking Completo</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Sobre o Ranking</a></li>
                    <li><a href="{{ route('sitemap') }}" class="hover:text-white transition-colors">Sitemap</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 text-center py-4 text-xs">
            &copy; {{ date('Y') }} Top 100 Instagram Brasil. Dados atualizados diariamente.
        </div>
    </footer>

    @stack('scripts')

    @if(isset($jsonLd))
    <script type="application/ld+json">{!! $jsonLd !!}</script>
    @endif
</body>
</html>
