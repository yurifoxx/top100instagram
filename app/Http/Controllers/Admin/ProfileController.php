<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InstagramProfile;
use App\Models\RankingHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = InstagramProfile::with('category')->orderBy('rank');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%')
                  ->orWhere('full_name', 'like', '%' . $request->search . '%');
            });
        }

        $profiles = $query->paginate(20)->withQueryString();
        $categories = Category::orderBy('label')->get();

        return view('admin.profiles.index', compact('profiles', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('label')->get();
        return view('admin.profiles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['last_updated_at'] = Carbon::now();
        InstagramProfile::create($data);
        return redirect()->route('admin.profiles.index')->with('success', 'Perfil criado com sucesso!');
    }

    public function edit(InstagramProfile $profile)
    {
        $categories = Category::orderBy('label')->get();
        return view('admin.profiles.edit', compact('profile', 'categories'));
    }

    public function update(Request $request, InstagramProfile $profile)
    {
        $data = $this->validated($request, $profile->id);
        $data['last_updated_at'] = Carbon::now();

        RankingHistory::create([
            'profile_id'      => $profile->id,
            'rank'            => $profile->rank,
            'followers_count' => $profile->followers_count,
            'recorded_at'     => Carbon::now(),
        ]);

        $profile->update($data);
        return redirect()->route('admin.profiles.index')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy(InstagramProfile $profile)
    {
        $profile->delete();
        return redirect()->route('admin.profiles.index')->with('success', 'Perfil removido.');
    }

    public function import(Request $request)
    {
        $request->validate(['csv' => 'required|file|mimes:csv,txt|max:2048']);

        $path = $request->file('csv')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $header = array_shift($rows);

        $count = 0;
        foreach ($rows as $row) {
            if (count($row) < 3) continue;
            $data = array_combine($header, $row);
            if (empty($data['username'])) continue;

            InstagramProfile::updateOrCreate(
                ['username' => $data['username']],
                array_filter([
                    'rank'            => $data['rank'] ?? null,
                    'full_name'       => $data['full_name'] ?? null,
                    'followers_count' => $data['followers_count'] ?? null,
                    'rank_change'     => $data['rank_change'] ?? 0,
                    'is_verified'     => isset($data['is_verified']) ? (bool)$data['is_verified'] : false,
                    'last_updated_at' => Carbon::now(),
                ])
            );
            $count++;
        }

        return redirect()->route('admin.profiles.index')->with('success', "{$count} perfis importados.");
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'rank'            => 'required|integer|min:1|max:1000',
            'username'        => 'required|string|max:50|unique:instagram_profiles,username,' . ($ignoreId ?? 'NULL'),
            'full_name'       => 'required|string|max:255',
            'bio'             => 'nullable|string|max:500',
            'followers_count' => 'required|integer|min:0',
            'following_count' => 'nullable|integer|min:0',
            'posts_count'     => 'nullable|integer|min:0',
            'avatar_url'      => 'nullable|url|max:500',
            'is_verified'     => 'boolean',
            'category_id'     => 'nullable|exists:categories,id',
            'rank_change'     => 'nullable|integer',
            'is_active'       => 'boolean',
        ]);
    }
}
