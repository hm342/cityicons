<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Article;
use App\Models\Person;

class CityFrontendController extends Controller
{
    /**
     * Display a dynamic city edition network page.
     * All relations are eager-loaded to eliminate N+1 queries.
     */
    public function show($slug)
    {
        $city = City::where('slug', strtolower($slug))->firstOrFail();
        $cityId = $city->slug;
        $cityName = $city->name;

        // 1. Hero Slides (4 items)
        $heroSlides = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        if ($heroSlides->count() < 4) {
            $extraHero = Article::with(['category', 'tags'])
                ->published()
                ->where('city_id', $city->id)
                ->whereNotIn('id', $heroSlides->pluck('id'))
                ->latest()
                ->take(4 - $heroSlides->count())
                ->get();
            $heroSlides = $heroSlides->concat($extraHero);
        }

        if ($heroSlides->count() < 4) {
            $nationalHero = Article::with(['category', 'tags'])
                ->published()
                ->whereNotIn('id', $heroSlides->pluck('id'))
                ->latest()
                ->take(4 - $heroSlides->count())
                ->get();
            $heroSlides = $heroSlides->concat($nationalHero);
        }

        $usedIds = $heroSlides->pluck('id')->toArray();

        // 2. Section 1: Culture & Heritage (5 items: 1 tall left + 4 right 2x2)
        $cultureStories = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->whereHas('category', function ($q) {
                $q->whereIn('slug', ['culture', 'places', 'art', 'events']);
            })
            ->whereNotIn('id', $usedIds)
            ->latest()
            ->take(5)
            ->get();

        if ($cultureStories->count() < 5) {
            $moreCulture = Article::with(['category', 'tags'])
                ->published()
                ->where('city_id', $city->id)
                ->whereNotIn('id', array_merge($usedIds, $cultureStories->pluck('id')->toArray()))
                ->latest()
                ->take(5 - $cultureStories->count())
                ->get();
            $cultureStories = $cultureStories->concat($moreCulture);
        }

        if ($cultureStories->count() < 5) {
            $nationalCulture = Article::with(['category', 'tags'])
                ->published()
                ->whereNotIn('id', array_merge($usedIds, $cultureStories->pluck('id')->toArray()))
                ->latest()
                ->take(5 - $cultureStories->count())
                ->get();
            $cultureStories = $cultureStories->concat($nationalCulture);
        }

        $usedIds = array_merge($usedIds, $cultureStories->pluck('id')->toArray());

        // 3. Section 2: Culinary & Taste (5 items: 2 left + 1 center tall + 2 right)
        $culinaryStories = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->whereHas('category', function ($q) {
                $q->whereIn('slug', ['food', 'living', 'lifestyle', 'taste', 'dining']);
            })
            ->whereNotIn('id', $usedIds)
            ->latest()
            ->take(5)
            ->get();

        if ($culinaryStories->count() < 5) {
            $moreCulinary = Article::with(['category', 'tags'])
                ->published()
                ->where('city_id', $city->id)
                ->whereNotIn('id', array_merge($usedIds, $culinaryStories->pluck('id')->toArray()))
                ->latest()
                ->take(5 - $culinaryStories->count())
                ->get();
            $culinaryStories = $culinaryStories->concat($moreCulinary);
        }

        if ($culinaryStories->count() < 5) {
            $nationalCulinary = Article::with(['category', 'tags'])
                ->published()
                ->whereNotIn('id', array_merge($usedIds, $culinaryStories->pluck('id')->toArray()))
                ->latest()
                ->take(5 - $culinaryStories->count())
                ->get();
            $culinaryStories = $culinaryStories->concat($nationalCulinary);
        }

        $usedIds = array_merge($usedIds, $culinaryStories->pluck('id')->toArray());

        // 4. Section 3: Fashion & Craft (5 items: 2 top 60/40 + 3 bottom)
        $fashionStories = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->whereHas('category', function ($q) {
                $q->whereIn('slug', ['fashion', 'beauty', 'art', 'street-style', 'craft']);
            })
            ->whereNotIn('id', $usedIds)
            ->latest()
            ->take(5)
            ->get();

        if ($fashionStories->count() < 5) {
            $moreFashion = Article::with(['category', 'tags'])
                ->published()
                ->where('city_id', $city->id)
                ->whereNotIn('id', array_merge($usedIds, $fashionStories->pluck('id')->toArray()))
                ->latest()
                ->take(5 - $fashionStories->count())
                ->get();
            $fashionStories = $fashionStories->concat($moreFashion);
        }

        if ($fashionStories->count() < 5) {
            $nationalFashion = Article::with(['category', 'tags'])
                ->published()
                ->whereNotIn('id', array_merge($usedIds, $fashionStories->pluck('id')->toArray()))
                ->latest()
                ->take(5 - $fashionStories->count())
                ->get();
            $fashionStories = $fashionStories->concat($nationalFashion);
        }

        $usedIds = array_merge($usedIds, $fashionStories->pluck('id')->toArray());

        // 5. Section 4: People & Voices (6 people for 3x2 grid)
        $people = Person::with(['category'])
            ->published()
            ->where('city_id', $city->id)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        if ($people->count() < 6) {
            $morePeople = Person::with(['category'])
                ->published()
                ->whereNotIn('id', $people->pluck('id'))
                ->orderBy('sort_order')
                ->take(6 - $people->count())
                ->get();
            $people = $people->concat($morePeople);
        }

        // 6. Section 5: Editorial Dispatches / Blog Stream (4 items: 50/50 horizontal split)
        $blogStories = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->whereNotIn('id', $usedIds)
            ->latest()
            ->take(4)
            ->get();

        if ($blogStories->count() < 4) {
            $moreBlog = Article::with(['category', 'tags'])
                ->published()
                ->whereNotIn('id', array_merge($usedIds, $blogStories->pluck('id')->toArray()))
                ->latest()
                ->take(4 - $blogStories->count())
                ->get();
            $blogStories = $blogStories->concat($moreBlog);
        }

        if ($blogStories->count() < 4) {
            $finalFallback = Article::with(['category', 'tags'])
                ->published()
                ->latest()
                ->take(4)
                ->get();
            $blogStories = $blogStories->concat($finalFallback)->unique('id')->take(4);
        }

        return view('city', compact(
            'city',
            'cityId',
            'cityName',
            'heroSlides',
            'cultureStories',
            'culinaryStories',
            'fashionStories',
            'people',
            'blogStories'
        ));
    }
}
