<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $activeCityId = session('admin_city_id');
        $query = Tag::withCount(['articles', 'people'])->with('city')->orderBy('name');

        if ($activeCityId) {
            $query->where(function ($q) use ($activeCityId) {
                $q->whereNull('city_id')->orWhere('city_id', $activeCityId);
            });
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $tags = $query->paginate(30)->withQueryString();

        return view('admin.tags.index', compact('tags', 'activeCityId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'city_id' => ['nullable', 'exists:cities,id'],
        ]);

        $activeCityId = session('admin_city_id');
        if ($activeCityId && !$request->boolean('is_global')) {
            $validated['city_id'] = $activeCityId;
        }

        $validated['slug'] = Str::slug($validated['name']);
        Tag::create($validated);

        return back()->with('success', 'Tag created successfully.');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->articles()->detach();
        $tag->people()->detach();
        $tag->delete();

        return back()->with('success', 'Tag deleted.');
    }
}
