<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['profiles' => fn($q) => $q->where('is_active', true)])
            ->orderBy('label')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:50|unique:categories,name',
            'label' => 'required|string|max:100',
            'icon'  => 'nullable|string|max:10',
        ]);

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Categoria criada!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Categoria removida.');
    }
}
