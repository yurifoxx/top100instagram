@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-br from-purple-700 via-pink-600 to-orange-500 text-white py-12 px-4">
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-black mb-6">Buscar Perfis</h1>
        <form action="{{ route('search') }}" method="GET">
            <div class="flex gap-2">
                <input type="text" name="q" value="{{ $q }}"
                       placeholder="Nome ou @username..."
                       autofocus
                       class="flex-1 px-5 py-3 rounded-full text-gray-900 text-base focus:outline-none focus:ring-4 focus:ring-white/40">
                <button type="submit"
                        class="px-6 py-3 bg-white text-purple-700 font-bold rounded-full hover:bg-purple-50 transition-colors">
                    Buscar
                </button>
            </div>
        </form>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-10">

    @if(strlen($q) < 2)
        <p class="text-center text-gray-500 py-16 text-lg">Digite ao menos 2 caracteres para buscar.</p>
    @elseif($profiles->isEmpty())
        <p class="text-center text-gray-500 py-16 text-lg">
            Nenhum perfil encontrado para <strong>{{ $q }}</strong>.
        </p>
    @else
        <p class="text-sm text-gray-500 mb-6">
            {{ $profiles->count() }} {{ $profiles->count() === 1 ? 'resultado' : 'resultados' }} para
            <strong>{{ $q }}</strong>
        </p>

        <div class="space-y-3">
            @foreach($profiles as $profile)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <a href="{{ route('profile.show', $profile->username) }}" class="flex items-center gap-4 p-4">

                    {{-- Rank badge --}}
                    <div class="flex-shrink-0 w-12 text-center">
                        @if($profile->rank === 1)
                            <span class="text-3xl">&#x1F947;</span>
                        @elseif($profile->rank === 2)
                            <span class="text-3xl">&#x1F948;</span>
                        @elseif($profile->rank === 3)
                            <span class="text-3xl">&#x1F949;</span>
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
                            <span title="Conta verificada" class="text-blue-500">&#x2714;</span>
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
    @endif

</section>

@endsection
