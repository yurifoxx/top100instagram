<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InstagramProfile;

class HomeController extends Controller
{
    public function apiRanking(\Illuminate\Http\Request $request)
    {
        $category = $request->query('category');
        $limit = $request->query('limit', 100);

        $cacheKey = 'api_ranking_' . md5($request->fullUrl());

        $data = \Illuminate\Support\Facades\Cache::remember($cacheKey, 3600, function () use ($category, $limit) {
            $query = InstagramProfile::ranking()->with('category');

            if ($category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('name', $category);
                });
            }

            $profiles = $query->limit($limit)->get();

            return $profiles->map(function ($profile) {
                return [
                    'rank'            => $profile->rank,
                    'username'        => $profile->username,
                    'full_name'       => $profile->full_name,
                    'followers_count' => $profile->followers_count,
                    'rank_change'     => $profile->rank_change,
                    'category'        => [
                        'name' => $profile->category ? $profile->category->name : null,
                    ],
                    'is_verified'     => $profile->is_verified,
                    'avatar_url'      => $profile->avatar_url,
                    'profile_url'     => $profile->profile_url,
                ];
            });
        });

        return response()->json([
            'data'       => $data,
            'updated_at' => now(),
        ]);
    }

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
