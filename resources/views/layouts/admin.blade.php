<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') | Top 100 Instagram Brasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="flex min-h-screen" x-data="{ sidebarOpen: false }">
    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-white flex flex-col fixed inset-y-0 left-0 z-30 transform transition-transform"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        <div class="px-6 py-5 border-b border-gray-700">
            <span class="text-xl font-black bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                📸 Admin Panel
            </span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                <span>🏠</span> Dashboard
            </a>
            <a href="{{ route('admin.profiles.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.profiles.*') ? 'bg-gray-700' : '' }}">
                <span>👤</span> Perfis
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700' : '' }}">
                <span>🏷️</span> Categorias
            </a>
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                <span>🌐</span> Ver Site
            </a>
        </nav>
        <div class="px-4 py-4 border-t border-gray-700">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm text-gray-400 hover:text-white">
                    <span>🚪</span> Sair
                </button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 lg:ml-64 flex flex-col">
        {{-- Topbar --}}
        <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">
            <button class="lg:hidden text-gray-600" x-on:click="sidebarOpen = !sidebarOpen">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-lg font-semibold text-gray-700">@yield('title', 'Dashboard')</h1>
            <span class="text-sm text-gray-500">{{ auth('admin')->user()->name }}</span>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-6">
            @if(session('success'))
            <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
