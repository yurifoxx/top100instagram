<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InstagramProfile;

class SitemapController extends Controller
{
    public function index()
    {
        $profiles   = InstagramProfile::where('is_active', true)->get(['username', 'last_updated_at']);
        $categories = Category::all(['name']);

        return response()->view('sitemap', compact('profiles', 'categories'))
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        return response()->view('robots')
            ->header('Content-Type', 'text/plain');
    }
}
