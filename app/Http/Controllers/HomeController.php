<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Person;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\City;
use App\Models\MagazineEdition;

class HomeController extends Controller
{
    /**
     * Render the All-India CityIcons Portal homepage (Vogue Luxury Editorial UI).
     * Showcases all 10 cities with direct access to city subsites, top national stories,
     * dispatches ticker, and magazine editions.
     */
    public function index()
    {
        // 1. All Active Indian Cities with counts
        $cities = City::where('is_active', true)
            ->withCount(['people', 'articles'])
            ->orderByRaw("CASE WHEN slug = 'bhavnagar' THEN 0 ELSE 1 END")
            ->orderBy('sort_order')
            ->get();

        // 2. Cover / Lead National Story
        $coverArticle = Article::with(['category', 'city'])
            ->published()
            ->cover()
            ->first();

        if (!$coverArticle) {
            $coverArticle = Article::with(['category', 'city'])
                ->published()
                ->featured()
                ->latest()
                ->first();
        }

        // 3. All-India City Dispatches Ticker (latest 8 articles across all cities)
        $newsStrip = Article::with(['category', 'city'])
            ->published()
            ->latest()
            ->take(8)
            ->get();

        // 4. Featured National Icons (from across cities)
        $featuredIcons = Person::with(['category', 'city'])
            ->published()
            ->icons()
            ->orderBy('sort_order')
            ->latest()
            ->take(7)
            ->get();

        // 5. Featured National Stories
        $featuredStories = Article::with(['category', 'city'])
            ->published()
            ->latest()
            ->take(6)
            ->get();

        // 6. The List Preview (Alphabetical national overview)
        $theListPreview = Person::with(['category', 'city'])
            ->published()
            ->orderBy('name', 'asc')
            ->take(6)
            ->get();

        // 7. National Magazine Edition
        $magazineEdition = MagazineEdition::where('is_active', true)
            ->latest()
            ->first();

        // 8. Featured Brand Partners
        $featuredBrands = Brand::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // 9. Site Settings
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('home', compact(
            'cities',
            'coverArticle',
            'newsStrip',
            'featuredIcons',
            'featuredStories',
            'theListPreview',
            'magazineEdition',
            'featuredBrands',
            'settings'
        ));
    }
}
