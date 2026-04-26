<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InstagramProfile;

class HomeController extends Controller
{
    public function index()
    {
        $profiles = InstagramProfile::with('category')
            ->ranking()
            ->get();

        $categories = Category::withCount(['profiles' => fn($q) => $q->where('is_active', true)])
            ->orderBy('label')
            ->get();

        $lastUpdated = InstagramProfile::max('last_updated_at');

        $seo = [
            'title'       => 'Top 100 Instagrams Mais Seguidos do Brasil 2025',
            'description' => 'Veja o ranking completo dos 100 perfis do Instagram com mais seguidores no Brasil. Atualizado diariamente com celebridades, atletas, influencers e músicos.',
            'canonical'   => route('home'),
        ];

        return view('home', compact('profiles', 'categories', 'lastUpdated', 'seo'));
    }
}
