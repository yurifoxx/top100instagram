@extends('layouts.admin')
@section('title', 'Editar Perfil')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.profiles.index') }}" class="text-sm text-gray-500 hover:text-purple-600 mb-6 inline-block">
        ← Voltar para Perfis
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Editar: {{ $profile->full_name }}</h2>

        @if($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.profiles.update', $profile) }}" class="space-y-5">
            @csrf @method('PUT')
            @include('admin.profiles._form')
            <div class="pt-2">
                <button type="submit"
                        class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-6 py-2.5 rounded-lg font-medium hover:opacity-90 text-sm">
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
