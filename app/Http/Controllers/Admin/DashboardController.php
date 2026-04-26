<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InstagramProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'       => InstagramProfile::where('is_active', true)->count(),
            'categories'  => Category::count(),
            'lastUpdated' => InstagramProfile::max('last_updated_at'),
            'topFollowers'=> InstagramProfile::where('is_active', true)->orderBy('followers_count', 'desc')->first(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
