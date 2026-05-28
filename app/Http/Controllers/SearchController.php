<?php

namespace App\Http\Controllers;

use App\Models\InstagramProfile;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));

        $profiles = collect();
        if (strlen($q) >= 2) {
            $profiles = InstagramProfile::with('category')
                ->ranking()
                ->where(function ($query) use ($q) {
                    $query->where('username', 'like', "%{$q}%")
                          ->orWhere('full_name', 'like', "%{$q}%");
                })
                ->get();
        }

        $seo = [
            'title'       => $q ? "Busca por \"{$q}\" — Top 100 Instagram Brasil" : 'Buscar perfis — Top 100 Instagram Brasil',
            'description' => 'Encontre perfis no ranking do Top 100 Instagrams mais seguidos do Brasil.',
            'canonical'   => route('search', ['q' => $q]),
        ];

        return view('search', compact('profiles', 'q', 'seo'));
    }
}
