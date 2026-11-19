<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\City;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'city', 'tags'])->latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('author_name', 'like', "%{$s}%")
                  ->orWhere('excerpt', 'like', "%{$s}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $activeCityId = session('admin_city_id');
        if ($activeCityId) {
            $query->where('city_id', $activeCityId);
        } elseif ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.articles.index', compact('articles', 'categories', 'cities', 'activeCityId'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $selectedCityId = session('admin_city_id');

        return view('admin.articles.create', compact('categories', 'cities', 'tags', 'selectedCityId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['nullable', 'string', 'max:255', 'unique:articles,slug'],
            'excerpt'          => ['nullable', 'string'],
            'body'             => ['nullable', 'string'],
            'author_name'      => ['nullable', 'string', 'max:255'],
            'author_bio'       => ['nullable', 'string'],
            'category_id'      => ['nullable', 'exists:categories,id'],
            'city_id'          => ['nullable', 'exists:cities,id'],
            'type'             => ['required', 'in:article,story,in-bhavnagar,the-list'],
            'section'          => ['required', 'in:icons,rising,general'],
            'status'           => ['required', 'in:draft,published,archived'],
            'is_cover'         => ['boolean'],
            'is_featured'      => ['boolean'],
            'read_time'        => ['nullable', 'string', 'max:50'],
            'cover_image_file' => ['nullable', 'image', 'max:5120'],
            'cover_image_url'  => ['nullable', 'url'],
            'tags'             => ['nullable', 'array'],
            'tags.*'           => ['exists:tags,id'],
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        // Ensure uniqueness if slug exists
        $origSlug = $validated['slug'];
        $count = 1;
        while (Article::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $origSlug . '-' . $count++;
        }

        $validated['is_cover'] = $request->boolean('is_cover');
        $validated['is_featured'] = $request->boolean('is_featured');

        // Handle cover image: either file upload or URL
        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('articles', 'public');
            $validated['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $validated['cover_image'] = $request->cover_image_url;
        }

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        unset($validated['cover_image_file'], $validated['cover_image_url'], $validated['tags']);

        $article = Article::create($validated);

        if ($request->filled('tags')) {
            $article->tags()->sync($request->tags);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit($id)
    {
        $article = Article::with('tags')->findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.articles.edit', compact('article', 'categories', 'cities', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['nullable', 'string', 'max:255', 'unique:articles,slug,' . $article->id],
            'excerpt'          => ['nullable', 'string'],
            'body'             => ['nullable', 'string'],
            'author_name'      => ['nullable', 'string', 'max:255'],
            'author_bio'       => ['nullable', 'string'],
            'category_id'      => ['nullable', 'exists:categories,id'],
            'city_id'          => ['nullable', 'exists:cities,id'],
            'type'             => ['required', 'in:article,story,in-bhavnagar,the-list'],
            'section'          => ['required', 'in:icons,rising,general'],
            'status'           => ['required', 'in:draft,published,archived'],
            'is_cover'         => ['boolean'],
            'is_featured'      => ['boolean'],
            'read_time'        => ['nullable', 'string', 'max:50'],
            'cover_image_file' => ['nullable', 'image', 'max:5120'],
            'cover_image_url'  => ['nullable', 'url'],
            'tags'             => ['nullable', 'array'],
            'tags.*'           => ['exists:tags,id'],
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_cover'] = $request->boolean('is_cover');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('articles', 'public');
            $validated['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $validated['cover_image'] = $request->cover_image_url;
        }

        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        }

        unset($validated['cover_image_file'], $validated['cover_image_url'], $validated['tags']);

        $article->update($validated);

        if ($request->has('tags')) {
            $article->tags()->sync($request->tags ?? []);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->tags()->detach();
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted.');
    }
}
