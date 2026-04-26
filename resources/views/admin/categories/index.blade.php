@extends('layouts.admin')
@section('title', 'Categorias')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- List --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50">
            <h2 class="font-semibold text-gray-800">Categorias</h2>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Ícone</th>
                    <th class="px-4 py-3 text-left">Label</th>
                    <th class="px-4 py-3 text-left">Slug</th>
                    <th class="px-4 py-3 text-left">Perfis</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($categories as $cat)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-xl">{{ $cat->icon }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $cat->label }}</td>
                    <td class="px-4 py-3 text-gray-500 font-mono text-xs">{{ $cat->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $cat->profiles_count }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                              onsubmit="return confirm('Remover categoria {{ $cat->label }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Create --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="font-semibold text-gray-800 mb-5">Nova Categoria</h2>

        @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug (único)</label>
                <input type="text" name="name" value="{{ old('name') }}" required maxlength="50"
                       placeholder="ex: modelo"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                <input type="text" name="label" value="{{ old('label') }}" required maxlength="100"
                       placeholder="ex: Modelo"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ícone (emoji)</label>
                <input type="text" name="icon" value="{{ old('icon') }}" maxlength="10"
                       placeholder="ex: 💃"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <button type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white font-medium py-2.5 rounded-lg hover:opacity-90 text-sm">
                Criar Categoria
            </button>
        </form>
    </div>

</div>

@endsection
