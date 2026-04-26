@extends('layouts.app')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {"@@type":"ListItem","position":1,"name":"Top 100","item":"{{ route('home') }}"},
    {"@@type":"ListItem","position":2,"name":"{{ $category->label }}","item":"{{ route('category.show', $category->name) }}"}
  ]
}
</script>
@endpush

@section('content')

<div class="bg-gradient-to-br from-purple-700 to-pink-600 text-white py-12 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <div class="text-5xl mb-3">{{ $category->icon }}</div>
        <h1 class="text-3xl md:text-4xl font-black mb-3">
            Top {{ $category->label }}s no Instagram Brasil
        </h1>
        <p class="text-white/90">Os {{ $category->label }}s com mais seguidores no Instagram do Brasil</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-10">
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Ranking</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700">{{ $category->label }}</span>
    </nav>

    @if($profiles->isEmpty())
    <div class="text-center py-16 text-gray-400">
        <div class="text-5xl mb-4">🔍</div>
        <p>Nenhum perfil encontrado nesta categoria.</p>
    </div>
    @else
    <div class="space-y-3">
        @foreach($profiles as $profile)
        <a href="{{ route('profile.show', $profile->username) }}"
           class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="w-10 text-center font-black text-gray-300 text-xl">#{{ $profile->rank }}</div>
            @if($profile->avatar_url)
            <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}" class="w-12 h-12 rounded-full border border-gray-100 object-cover">
            @else
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold">
                {{ strtoupper(substr($profile->full_name, 0, 1)) }}
            </div>
            @endif
            <div class="flex-1 min-w-0">
                <div class="font-bold text-gray-900 truncate">{{ $profile->full_name }}
                    @if($profile->is_verified)<span class="text-blue-500 text-sm">✔</span>@endif
                </div>
                <div class="text-sm text-gray-500">@{{ $profile->username }}</div>
            </div>
            <div class="text-right">
                <div class="font-black text-gray-800">{{ $profile->formatted_followers }}</div>
                <div class="text-xs text-gray-400">seguidores</div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>

@endsection
