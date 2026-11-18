<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['articles', 'people'])->orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'type'       => ['required', 'in:article,person'],
            'color'      => ['nullable', 'string', 'max:7'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        Category::create($validated);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'type'       => ['required', 'in:article,person'],
            'color'      => ['nullable', 'string', 'max:7'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $category->update($validated);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Category deleted.');
    }
}
