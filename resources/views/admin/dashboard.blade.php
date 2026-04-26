@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="text-3xl mb-2">👤</div>
        <div class="text-3xl font-black text-gray-800">{{ $stats['total'] }}</div>
        <div class="text-sm text-gray-500 mt-1">Perfis ativos</div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="text-3xl mb-2">🏷️</div>
        <div class="text-3xl font-black text-gray-800">{{ $stats['categories'] }}</div>
        <div class="text-sm text-gray-500 mt-1">Categorias</div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="text-3xl mb-2">🔄</div>
        <div class="text-xl font-bold text-gray-800">
            {{ $stats['lastUpdated'] ? \Carbon\Carbon::parse($stats['lastUpdated'])->format('d/m/Y') : 'Nunca' }}
        </div>
        <div class="text-sm text-gray-500 mt-1">Última atualização</div>
    </div>
    @if($stats['topFollowers'])
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="text-3xl mb-2">🏆</div>
        <div class="text-lg font-bold text-gray-800 truncate">{{ $stats['topFollowers']->full_name }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ $stats['topFollowers']->formatted_followers }} seguidores</div>
    </div>
    @endif
</div>

<div class="flex gap-4 flex-wrap">
    <a href="{{ route('admin.profiles.create') }}"
       class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-pink-500 text-white px-5 py-2.5 rounded-lg font-medium hover:opacity-90 transition-opacity text-sm">
        + Novo Perfil
    </a>
    <a href="{{ route('admin.profiles.index') }}"
       class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-50 transition-colors text-sm">
        Ver Todos os Perfis
    </a>
    <a href="{{ route('home') }}" target="_blank"
       class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-50 transition-colors text-sm">
        🌐 Ver Site Público
    </a>
</div>

@endsection
