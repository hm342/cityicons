<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Person;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\City;

class HomeController extends Controller
{
    /**
     * Render the flagship homepage (Bhavnagar Icons) with real database queries.
     * All relations are eager-loaded to strictly prevent N+1 query overhead.
     */
    public function index()
    {
        // 1. Cover Story
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

        // 2. City News Strip / Dispatch Ticker (latest 6 articles)
        $newsStrip = Article::published()
            ->latest()
            ->take(6)
            ->get(['id', 'title', 'slug', 'category_id', 'created_at']);

        // 3. Featured Icons (People tier = icon) - Eager loaded
        $icons = Person::with(['category', 'city'])
            ->published()
            ->icons()
            ->orderBy('sort_order')
            ->latest()
            ->take(7)
            ->get();

        // 4. Rising Stars (People tier = rising) - Eager loaded
        $rising = Person::with(['category', 'city'])
            ->published()
            ->rising()
            ->orderBy('sort_order')
            ->latest()
            ->take(7)
            ->get();

        // 5. In Bhavnagar Local Feature Articles - Eager loaded
        $bhavnagarCity = City::where('slug', 'bhavnagar')->first();
        $bhavnagarCityId = $bhavnagarCity ? $bhavnagarCity->id : null;

        $inBhavnagar = Article::with(['category', 'city'])
            ->published()
            ->where(function ($q) use ($bhavnagarCityId) {
                $q->where('section', 'in-bhavnagar');
                if ($bhavnagarCityId) {
                    $q->orWhere('city_id', $bhavnagarCityId);
                }
            })
            ->latest()
            ->take(6)
            ->get();

        // 6. Voices (People tier = voice) - Eager loaded
        $voices = Person::with(['category', 'city'])
            ->published()
            ->voices()
            ->orderBy('sort_order')
            ->latest()
            ->take(4)
            ->get();

        // 7. Featured Brand Partners (clearly disclosed)
        $featuredBrands = Brand::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // 8. Site Settings (keyed array)
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('home', compact(
            'coverArticle',
            'newsStrip',
            'icons',
            'rising',
            'inBhavnagar',
            'voices',
            'featuredBrands',
            'settings'
        ));
    }
}
