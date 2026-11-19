<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        $activeCityId = session('admin_city_id');
        $query = Category::withCount(['articles', 'people'])->with('city')->orderBy('sort_order');

        if ($activeCityId) {
            $query->where(function ($q) use ($activeCityId) {
                $q->whereNull('city_id')->orWhere('city_id', $activeCityId);
            });
        }

        $categories = $query->get();
        return view('admin.categories.index', compact('categories', 'activeCityId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'type'       => ['required', 'in:article,person'],
            'color'      => ['nullable', 'string', 'max:7'],
            'sort_order' => ['nullable', 'integer'],
            'city_id'    => ['nullable', 'exists:cities,id'],
        ]);

        $activeCityId = session('admin_city_id');
        if ($activeCityId && !$request->boolean('is_global')) {
            $validated['city_id'] = $activeCityId;
        }

        $validated['slug'] = Str::slug($validated['name']);
        Category::create($validated);

        Cache::forget('all_categories');

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

        Cache::forget('all_categories');

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        Cache::forget('all_categories');

        return back()->with('success', 'Category deleted.');
    }
}
