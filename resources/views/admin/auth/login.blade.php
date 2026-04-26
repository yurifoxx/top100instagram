<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Login Admin | Top 100 Instagram Brasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-700 to-pink-600 min-h-screen flex items-center justify-center px-4">

<div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-8">
    <div class="text-center mb-8">
        <span class="text-4xl">📸</span>
        <h1 class="text-2xl font-black text-gray-800 mt-3">Admin Panel</h1>
        <p class="text-gray-500 text-sm mt-1">Top 100 Instagram Brasil</p>
    </div>

    @if($errors->any())
    <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
        {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
            <input type="password" name="password" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember" class="rounded">
            <label for="remember" class="text-sm text-gray-600">Lembrar de mim</label>
        </div>
        <button type="submit"
                class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold py-3 rounded-lg hover:opacity-90 transition-opacity">
            Entrar
        </button>
    </form>
</div>

</body>
</html>
