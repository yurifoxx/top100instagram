<?php

namespace App\Http\Controllers;

use App\Models\InstagramProfile;

class ProfileController extends Controller
{
    public function show(string $username)
    {
        $profile = InstagramProfile::with(['category', 'histories' => fn($q) => $q->orderByDesc('recorded_at')->limit(30)])
            ->where('username', $username)
            ->where('is_active', true)
            ->firstOrFail();

        $seo = [
            'title'       => "@{$profile->username} — {$profile->full_name} | Top 100 Instagram Brasil",
            'description' => "Perfil de {$profile->full_name} no Instagram: {$profile->formatted_followers} seguidores. Posição #{$profile->rank} no ranking dos mais seguidos do Brasil.",
            'canonical'   => route('profile.show', $profile->username),
            'image'       => $profile->avatar_url,
        ];

        return view('profile.show', compact('profile', 'seo'));
    }
}
