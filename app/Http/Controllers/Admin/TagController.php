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
        $query = Tag::withCount(['articles', 'people'])->orderBy('name');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $tags = $query->paginate(30)->withQueryString();

        return view('admin.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
        ]);

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
