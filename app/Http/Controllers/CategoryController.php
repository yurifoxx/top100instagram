<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InstagramProfile;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::where('name', $slug)->firstOrFail();

        $profiles = InstagramProfile::with('category')
            ->where('category_id', $category->id)
            ->ranking()
            ->get();

        $seo = [
            'title'       => "Top {$category->label}s no Instagram Brasil 2025 | Top 100",
            'description' => "Os {$category->label}s com mais seguidores no Instagram do Brasil. Ranking completo e atualizado.",
            'canonical'   => route('category.show', $category->name),
        ];

        return view('category.show', compact('category', 'profiles', 'seo'));
    }
}
