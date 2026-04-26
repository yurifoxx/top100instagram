@extends('layouts.admin')
@section('title', 'Perfis')

@section('content')

<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <div class="flex gap-3">
        <a href="{{ route('admin.profiles.create') }}"
           class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90">
            + Novo Perfil
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" class="flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar perfil..."
               class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        <button type="submit" class="bg-gray-100 border border-gray-300 px-3 py-2 rounded-lg text-sm hover:bg-gray-200">
            🔍
        </button>
    </form>
</div>

{{-- Import CSV --}}
<div class="bg-white rounded-xl border border-gray-100 p-4 mb-6">
    <h3 class="text-sm font-semibold text-gray-700 mb-3">Importar CSV</h3>
    <form method="POST" action="{{ route('admin.profiles.import') }}" enctype="multipart/form-data" class="flex items-center gap-3 flex-wrap">
        @csrf
        <input type="file" name="csv" accept=".csv,.txt" required
               class="text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200">
        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-600">
            Importar
        </button>
        <span class="text-xs text-gray-400">Colunas: rank, username, full_name, followers_count, rank_change, is_verified</span>
    </form>
</div>

{{-- Table --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Perfil</th>
                    <th class="px-4 py-3 text-left">Seguidores</th>
                    <th class="px-4 py-3 text-left">Categoria</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($profiles as $profile)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-bold text-gray-400">#{{ $profile->rank }}</td>
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-800">{{ $profile->full_name }}</div>
                        <div class="text-gray-400 text-xs">@{{ $profile->username }}
                            @if($profile->is_verified)<span class="text-blue-400">✔</span>@endif
                        </div>
                    </td>
                    <td class="px-4 py-3 font-bold text-gray-700">{{ $profile->formatted_followers }}</td>
                    <td class="px-4 py-3">
                        @if($profile->category)
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">
                            {{ $profile->category->icon }} {{ $profile->category->label }}
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $profile->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $profile->is_active ? 'Ativo' : 'Inativo' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.profiles.edit', $profile) }}"
                               class="text-purple-600 hover:text-purple-800 text-xs font-medium">Editar</a>
                            <form method="POST" action="{{ route('admin.profiles.destroy', $profile) }}"
                                  onsubmit="return confirm('Remover este perfil?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">
                                    Remover
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-400">Nenhum perfil encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($profiles->hasPages())
    <div class="px-4 py-4 border-t border-gray-50">
        {{ $profiles->links() }}
    </div>
    @endif
</div>

@endsection
