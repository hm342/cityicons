<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class ArticleFrontendController extends Controller
{
    /**
     * Display long-form stories feed with search and filters.
     * SQL-injection safe parameterized querying.
     */
    public function stories(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        $query = Article::with(['category', 'city', 'tags'])
            ->published()
            ->latest();

        // Parameterized search preventing SQL injection
        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($b) use ($term) {
                $b->where('title', 'like', "%{$term}%")
                  ->orWhere('excerpt', 'like', "%{$term}%")
                  ->orWhere('author_name', 'like', "%{$term}%");
            });
        }

        if ($request->filled('category')) {
            $catSlug = $request->category;
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        if ($request->filled('section')) {
            $query->where('section', $request->section);
        }

        $stories = $query->paginate(12)->withQueryString();

        return view('pages.stories', compact('stories', 'categories', 'cities'));
    }

    /**
     * Display In Bhavnagar local events, culture, and happenings.
     */
    public function inBhavnagar(Request $request)
    {
        $bhavnagarCity = City::where('slug', 'bhavnagar')->first();
        $bhavnagarCityId = $bhavnagarCity ? $bhavnagarCity->id : null;

        $articles = Article::with(['category', 'city', 'tags'])
            ->published()
            ->where(function ($q) use ($bhavnagarCityId) {
                $q->where('section', 'in-bhavnagar');
                if ($bhavnagarCityId) {
                    $q->orWhere('city_id', $bhavnagarCityId);
                }
            })
            ->latest()
            ->paginate(12);

        return view('pages.in-bhavnagar', compact('articles'));
    }

    /**
     * Display a single editorial article by ID or slug.
     * Eager loads author, category, city, tags, and related stories.
     */
    public function show(Request $request, $id = null)
    {
        $identifier = $id ?? $request->query('id');

        if (!$identifier) {
            abort(404, 'Article not specified.');
        }

        $article = Article::with(['category', 'city', 'tags'])
            ->published()
            ->where(is_numeric($identifier) ? 'id' : 'slug', $identifier)
            ->firstOrFail();

        // Related stories (eager loaded to eliminate N+1)
        $related = Article::with(['category', 'city'])
            ->published()
            ->where('id', '!=', $article->id)
            ->where(function ($q) use ($article) {
                if ($article->category_id) {
                    $q->where('category_id', $article->category_id);
                }
                if ($article->city_id) {
                    $q->orWhere('city_id', $article->city_id);
                }
            })
            ->latest()
            ->take(3)
            ->get();

        return view('article', compact('article', 'related'));
    }
}
