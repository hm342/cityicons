<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class ArticleFrontendController extends Controller
{
    /**
     * Display city-scoped long-form stories feed (e.g. /bhavnagar/stories).
     */
    public function cityStories($citySlug, Request $request)
    {
        $city = City::where('slug', strtolower($citySlug))->first();
        if (!$city) {
            $city = City::where('slug', 'bhavnagar')->firstOrFail();
        }

        $categories = Category::orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        $query = Article::with(['category', 'city', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->latest();

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

        $stories = $query->paginate(12)->withQueryString();
        if ($stories->isEmpty() && !$request->filled('category') && !$request->filled('q')) {
            $stories = Article::with(['category', 'city', 'tags'])
                ->published()
                ->latest()
                ->paginate(12);
        }

        return view('pages.stories', compact('city', 'stories', 'categories', 'cities'));
    }

    /**
     * Display long-form stories feed across all cities.
     */
    public function stories(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        $query = Article::with(['category', 'city', 'tags'])
            ->published()
            ->latest();

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

        if ($request->filled('city')) {
            $cSlug = $request->city;
            $query->whereHas('city', function ($q) use ($cSlug) {
                $q->where('slug', $cSlug);
            });
        }

        $stories = $query->paginate(12)->withQueryString();
        $city = null;

        return view('pages.stories', compact('city', 'stories', 'categories', 'cities'));
    }

    /**
     * Display city-scoped In [City] local events, culture, and happenings (e.g. /bhavnagar/in-bhavnagar, /mumbai/in-mumbai).
     */
    public function cityInCity($citySlug, Request $request)
    {
        $city = City::where('slug', strtolower($citySlug))->first();
        if (!$city) {
            $city = City::where('slug', 'bhavnagar')->firstOrFail();
        }

        $categories = Category::orderBy('name')->get();

        $query = Article::with(['category', 'city', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->latest();

        if ($request->filled('category')) {
            $catSlug = $request->category;
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        if ($request->filled('q')) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', $searchTerm)
                  ->orWhere('excerpt', 'LIKE', $searchTerm)
                  ->orWhere('content', 'LIKE', $searchTerm);
            });
        }

        $articles = $query->paginate(12)->withQueryString();

        if ($articles->isEmpty() && !$request->filled('category') && !$request->filled('q')) {
            $articles = Article::with(['category', 'city', 'tags'])
                ->published()
                ->latest()
                ->paginate(12);
        }

        return view('pages.in-city', compact('city', 'articles', 'categories'));
    }

    /**
     * Display In Bhavnagar local events, culture, and happenings.
     */
    public function inBhavnagar(Request $request)
    {
        return $this->cityInCity('bhavnagar', $request);
    }

    /**
     * Display a single editorial article by ID or slug.
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
