@php $v = fn(string $k) => old($k, $profile->$k ?? ''); @endphp

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Rank *</label>
        <input type="number" name="rank" value="{{ $v('rank') }}" required min="1" max="1000"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Username *</label>
        <input type="text" name="username" value="{{ $v('username') }}" required maxlength="50"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Nome completo *</label>
    <input type="text" name="full_name" value="{{ $v('full_name') }}" required
           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
    <textarea name="bio" rows="3" maxlength="500"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">{{ $v('bio') }}</textarea>
</div>

<div class="grid grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Seguidores *</label>
        <input type="number" name="followers_count" value="{{ $v('followers_count') }}" required min="0"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Seguindo</label>
        <input type="number" name="following_count" value="{{ $v('following_count') }}" min="0"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Publicações</label>
        <input type="number" name="posts_count" value="{{ $v('posts_count') }}" min="0"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Variação de rank</label>
        <input type="number" name="rank_change" value="{{ $v('rank_change') }}"
               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
               placeholder="Ex: +3 ou -2">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
        <select name="category_id"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
            <option value="">— Sem categoria —</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id', $profile->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->icon }} {{ $cat->label }}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">URL do Avatar</label>
    <input type="url" name="avatar_url" value="{{ $v('avatar_url') }}"
           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
           placeholder="https://...">
</div>

<div class="flex items-center gap-6">
    <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', $profile->is_verified ?? false) ? 'checked' : '' }}
               class="rounded text-purple-600">
        <span class="text-sm text-gray-700">Conta verificada</span>
    </label>
    <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $profile->is_active ?? true) ? 'checked' : '' }}
               class="rounded text-purple-600">
        <span class="text-sm text-gray-700">Perfil ativo</span>
    </label>
</div>
