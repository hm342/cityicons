<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Article;
use App\Models\Person;

class CityFrontendController extends Controller
{
    /**
     * Display a dynamic city edition network page.
     * All relations are eager-loaded.
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

        // 6 Grid stories (excluding lead if present)
        $gridStories = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->when($lead, fn($q) => $q->where('id', '!=', $lead->id))
            ->latest()
            ->take(6)
            ->get();

        // City Documented People
        $people = Person::with(['category'])
            ->published()
            ->where('city_id', $city->id)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('city', compact('city', 'lead', 'gridStories', 'people'));
    }
}
