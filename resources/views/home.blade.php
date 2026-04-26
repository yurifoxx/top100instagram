@extends('layouts.app')

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ItemList",
  "name": "Top 100 Instagrams Mais Seguidos do Brasil",
  "description": "Ranking dos 100 perfis do Instagram com mais seguidores no Brasil",
  "url": "{{ route('home') }}",
  "numberOfItems": {{ $profiles->count() }},
  "itemListElement": [
    @foreach($profiles->take(20) as $profile)
    {
      "@@type": "ListItem",
      "position": {{ $profile->rank }},
      "url": "{{ route('profile.show', $profile->username) }}",
      "name": "{{ $profile->full_name }}"
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [{
    "@@type": "ListItem",
    "position": 1,
    "name": "Top 100 Instagram Brasil",
    "item": "{{ route('home') }}"
  }]
}
</script>
@endpush

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-purple-700 via-pink-600 to-orange-500 text-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-black mb-4 leading-tight">
            Top 100 Instagrams<br>Mais Seguidos do Brasil
        </h1>
        <p class="text-lg md:text-xl text-white/90 mb-6">
            O ranking completo e atualizado dos perfis brasileiros com mais seguidores no Instagram.
        </p>
        @if($lastUpdated)
        <span class="inline-flex items-center gap-2 bg-white/20 rounded-full px-4 py-2 text-sm font-medium backdrop-blur">
            🔄 Atualizado em {{ \Carbon\Carbon::parse($lastUpdated)->format('d/m/Y') }}
        </span>
        @endif
    </div>
</section>

{{-- Filters + Ranking --}}
<section class="max-w-6xl mx-auto px-4 py-10" x-data="{ activeCategory: 'todos' }">

    {{-- Category filters --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <button x-on:click="activeCategory = 'todos'"
                :class="activeCategory === 'todos' ? 'bg-purple-600 text-white' : 'bg-white text-gray-600 hover:bg-purple-50'"
                class="px-4 py-2 rounded-full text-sm font-medium border border-gray-200 transition-colors">
            ⭐ Todos ({{ $profiles->count() }})
        </button>
        @foreach($categories as $cat)
        @if($cat->profiles_count > 0)
        <button x-on:click="activeCategory = '{{ $cat->name }}'"
                :class="activeCategory === '{{ $cat->name }}' ? 'bg-purple-600 text-white' : 'bg-white text-gray-600 hover:bg-purple-50'"
                class="px-4 py-2 rounded-full text-sm font-medium border border-gray-200 transition-colors">
            {{ $cat->icon }} {{ $cat->label }} ({{ $cat->profiles_count }})
        </button>
        @endif
        @endforeach
    </div>

    {{-- Ranking list --}}
    <div class="space-y-3">
        @foreach($profiles as $profile)
        <div x-show="activeCategory === 'todos' || activeCategory === '{{ $profile->category?->name }}'"
             class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <a href="{{ route('profile.show', $profile->username) }}" class="flex items-center gap-4 p-4">

                {{-- Rank badge --}}
                <div class="flex-shrink-0 w-12 text-center">
                    @if($profile->rank === 1)
                        <span class="text-3xl">🥇</span>
                    @elseif($profile->rank === 2)
                        <span class="text-3xl">🥈</span>
                    @elseif($profile->rank === 3)
                        <span class="text-3xl">🥉</span>
                    @else
                        <span class="text-2xl font-black text-gray-300">#{{ $profile->rank }}</span>
                    @endif
                </div>

                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    @if($profile->avatar_url)
                    <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}"
                         class="w-14 h-14 rounded-full object-cover border-2 border-gray-100">
                    @else
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white text-xl font-bold">
                        {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-bold text-gray-900 truncate">{{ $profile->full_name }}</span>
                        @if($profile->is_verified)
                        <span title="Conta verificada" class="text-blue-500">✔</span>
                        @endif
                        @if($profile->category)
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">
                            {{ $profile->category->icon }} {{ $profile->category->label }}
                        </span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-500">@{{ $profile->username }}</div>
                    @if($profile->bio)
                    <div class="text-xs text-gray-400 mt-1 truncate">{{ $profile->bio }}</div>
                    @endif
                </div>

                {{-- Followers + trend --}}
                <div class="flex-shrink-0 text-right">
                    <div class="text-xl font-black text-gray-800">{{ $profile->formatted_followers }}</div>
                    <div class="text-xs text-gray-400">seguidores</div>
                    <div class="text-sm font-bold {{ $profile->rank_trend_color }} mt-1">
                        {{ $profile->rank_trend }}
                        @if($profile->rank_change != 0)
                        <span class="text-xs font-normal">{{ abs($profile->rank_change) }}</span>
                        @endif
                    </div>
                </div>

            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- SEO Content block --}}
<section class="max-w-4xl mx-auto px-4 pb-16">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Quem são os brasileiros com mais seguidores no Instagram?</h2>
        <p class="text-gray-600 leading-relaxed mb-4">
            O Brasil é um dos países com maior número de usuários no Instagram, e vários brasileiros figuram entre os perfis mais seguidos do mundo.
            Atletas como Neymar Jr, músicos como Anitta e influenciadores digitais como Whindersson Nunes dominam o ranking nacional.
        </p>
        <p class="text-gray-600 leading-relaxed">
            Este ranking é atualizado regularmente para refletir as mudanças no número de seguidores.
            Acompanhe a evolução das posições, descubra quem subiu ou caiu no ranking, e explore perfis por categoria.
        </p>
        <div class="mt-6 flex flex-wrap gap-3">
            @foreach($categories as $cat)
            @if($cat->profiles_count > 0)
            <a href="{{ route('category.show', $cat->name) }}"
               class="inline-flex items-center gap-1 px-4 py-2 bg-gray-100 hover:bg-purple-100 text-gray-700 hover:text-purple-700 rounded-full text-sm font-medium transition-colors">
                {{ $cat->icon }} {{ $cat->label }}s
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>

@endsection
