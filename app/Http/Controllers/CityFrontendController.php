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
        if (strtolower($slug) === 'bhavnagar') {
            return redirect()->route('home');
        }

        $city = City::where('slug', strtolower($slug))->firstOrFail();

        // Lead story
        $lead = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->latest()
            ->first();

        // If no city-specific lead, get national fallback
        if (!$lead) {
            $lead = Article::with(['category', 'tags'])->published()->latest()->first();
        }

        // 6 Grid stories
        $gridStories = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->when($lead, fn($q) => $q->where('id', '!=', $lead->id))
            ->latest()
            ->take(6)
            ->get();

        // Fallbacks if fewer than 6 city stories
        if ($gridStories->count() < 6) {
            $excludeIds = $gridStories->pluck('id')->all();
            if ($lead) $excludeIds[] = $lead->id;

            $fallbacks = Article::with(['category', 'tags'])
                ->published()
                ->whereNotIn('id', $excludeIds)
                ->latest()
                ->take(6 - $gridStories->count())
                ->get();

            $gridStories = $gridStories->concat($fallbacks);
        }

        // City Documented People
        $people = Person::with(['category'])
            ->published()
            ->where('city_id', $city->id)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        if ($people->count() < 4) {
            $excludePeopleIds = $people->pluck('id')->all();
            $peopleFallbacks = Person::with(['category'])
                ->published()
                ->whereNotIn('id', $excludePeopleIds)
                ->orderBy('sort_order')
                ->take(4 - $people->count())
                ->get();

            $people = $people->concat($peopleFallbacks);
        }

        return view('city', compact('city', 'lead', 'gridStories', 'people'));
    }
}
