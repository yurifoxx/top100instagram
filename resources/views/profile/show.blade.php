@extends('layouts.app')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Person",
  "name": "{{ $profile->full_name }}",
  "url": "{{ route('profile.show', $profile->username) }}",
  "sameAs": ["https://instagram.com/{{ $profile->username }}"],
  "description": "{{ $profile->bio }}",
  "image": "{{ $profile->avatar_url }}"
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {"@@type":"ListItem","position":1,"name":"Top 100","item":"{{ route('home') }}"},
    {"@@type":"ListItem","position":2,"name":"{{ $profile->full_name }}","item":"{{ route('profile.show', $profile->username) }}"}
  ]
}
</script>
@endpush

@section('content')

{{-- Breadcrumb --}}
<div class="max-w-4xl mx-auto px-4 pt-6">
    <nav class="text-sm text-gray-500 mb-6" aria-label="breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Ranking</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700">{{ $profile->full_name }}</span>
    </nav>
</div>

<div class="max-w-4xl mx-auto px-4 pb-16">

    {{-- Profile card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-pink-500 h-24"></div>
        <div class="px-6 pb-6">
            <div class="flex items-end gap-5 -mt-10 mb-5">
                @if($profile->avatar_url)
                <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}"
                     class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-md">
                @else
                <div class="w-24 h-24 rounded-full border-4 border-white bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white text-3xl font-bold shadow-md">
                    {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                </div>
                @endif
                <div class="pb-2">
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-black text-gray-900">{{ $profile->full_name }}</h1>
                        @if($profile->is_verified)
                        <span title="Conta verificada" class="text-blue-500 text-xl">✔</span>
                        @endif
                    </div>
                    <div class="text-gray-500">@{{ $profile->username }}</div>
                    @if($profile->category)
                    <span class="inline-block mt-1 text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">
                        {{ $profile->category->icon }} {{ $profile->category->label }}
                    </span>
                    @endif
                </div>
                <div class="ml-auto pb-2 text-right">
                    <div class="text-xs text-gray-400 uppercase tracking-wider">Posição no ranking</div>
                    <div class="text-4xl font-black text-purple-600">#{{ $profile->rank }}</div>
                    <div class="text-sm {{ $profile->rank_trend_color }} font-semibold">
                        {{ $profile->rank_trend }}
                        @if($profile->rank_change != 0)
                        {{ abs($profile->rank_change) }} posições
                        @else
                        sem mudança
                        @endif
                    </div>
                </div>
            </div>

            @if($profile->bio)
            <p class="text-gray-700 mb-6 leading-relaxed">{{ $profile->bio }}</p>
            @endif

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <div class="text-2xl font-black text-gray-900">{{ $profile->formatted_followers }}</div>
                    <div class="text-xs text-gray-500 mt-1">Seguidores</div>
                </div>
                @if($profile->following_count > 0)
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <div class="text-2xl font-black text-gray-900">
                        @php
                            $n = $profile->following_count;
                            echo $n >= 1000 ? round($n/1000,1).'K' : $n;
                        @endphp
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Seguindo</div>
                </div>
                @endif
                @if($profile->posts_count > 0)
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <div class="text-2xl font-black text-gray-900">
                        @php
                            $n = $profile->posts_count;
                            echo $n >= 1000 ? round($n/1000,1).'K' : $n;
                        @endphp
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Publicações</div>
                </div>
                @endif
            </div>

            <a href="https://instagram.com/{{ $profile->username }}" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-pink-500 text-white px-6 py-3 rounded-full font-semibold hover:opacity-90 transition-opacity">
                📸 Ver perfil no Instagram
            </a>
        </div>
    </div>

    {{-- History --}}
    @if($profile->histories->count() > 0)
    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Histórico de posições</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-left text-gray-500">
                        <th class="pb-3 pr-4">Data</th>
                        <th class="pb-3 pr-4">Posição</th>
                        <th class="pb-3">Seguidores</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($profile->histories as $h)
                    <tr>
                        <td class="py-2 pr-4 text-gray-500">{{ $h->recorded_at->format('d/m/Y') }}</td>
                        <td class="py-2 pr-4 font-semibold">#{{ $h->rank }}</td>
                        <td class="py-2">
                            @php
                                $n = $h->followers_count;
                                echo $n >= 1_000_000 ? round($n/1_000_000,1).'M' : ($n >= 1000 ? round($n/1000,1).'K' : $n);
                            @endphp
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Last updated --}}
    @if($profile->last_updated_at)
    <p class="text-center text-xs text-gray-400 mt-6">
        Dados atualizados em {{ $profile->last_updated_at->format('d/m/Y') }}
    </p>
    @endif

</div>

@endsection
