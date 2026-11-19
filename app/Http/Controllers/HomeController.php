<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\City;

class HomeController extends Controller
{
    /**
     * Render the All-India CityIcons Portal homepage.
     * Matches EXACTLY the user specification in index.html:
     * - Master Header & Sticky City Navigation
     * - Hero Big Banner (Dominant Cover Article)
     * - City News Carousel (Continuous Latest City Dispatch across India)
     * - Section 1: Bhavnagar (Sticky Lead + 6-Story Grid)
     * - Section 2: Mumbai (Sticky Lead + 6-Story Grid)
     * - Section 3: Ahmedabad (Cinematic Banner + Carousel Below)
     * - Section 4: Weddings & Celebrations (4-Column Collection Grid)
     * - Master Footer & Offcanvas Drawer
     */
    public function index()
    {
        // 1. All Active Indian Cities
        $cities = City::where('is_active', true)
            ->orderByRaw("CASE WHEN slug = 'bhavnagar' THEN 0 ELSE 1 END")
            ->orderBy('sort_order')
            ->get();

        // 2. Cover Article for Hero Big Banner
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

        if (!$coverArticle) {
            $coverArticle = Article::with(['category', 'city'])
                ->published()
                ->latest()
                ->first();
        }

        // 3. City News Carousel: 1 story from each city for the continuous city dispatch
        $newsStrip = collect();
        foreach ($cities as $city) {
            $art = Article::with(['category', 'city'])
                ->published()
                ->where('city_id', $city->id)
                ->latest()
                ->first();
            if ($art) {
                $newsStrip->push($art);
            }
        }
        if ($newsStrip->count() < 8) {
            $extra = Article::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $newsStrip->pluck('id'))
                ->latest()
                ->take(8 - $newsStrip->count())
                ->get();
            $newsStrip = $newsStrip->concat($extra);
        }

        // 4. Section 1: Bhavnagar (1 Lead + 6 Grid)
        $bhavCity = $cities->firstWhere('slug', 'bhavnagar');
        $bhavAll = Article::with(['category', 'city'])
            ->published()
            ->where('city_id', $bhavCity?->id)
            ->latest()
            ->take(7)
            ->get();
        if ($bhavAll->count() < 7) {
            $fallback = Article::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $bhavAll->pluck('id'))
                ->latest()
                ->take(7 - $bhavAll->count())
                ->get();
            $bhavAll = $bhavAll->concat($fallback);
        }
        $bhavLead = $bhavAll->first();
        $bhavGrid = $bhavAll->slice(1, 6);

        // 5. Section 2: Mumbai (1 Lead + 6 Grid)
        $mumbaiCity = $cities->firstWhere('slug', 'mumbai');
        $mumbaiAll = Article::with(['category', 'city'])
            ->published()
            ->where('city_id', $mumbaiCity?->id)
            ->latest()
            ->take(7)
            ->get();
        if ($mumbaiAll->count() < 7) {
            $fallback = Article::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $mumbaiAll->pluck('id'))
                ->latest()
                ->take(7 - $mumbaiAll->count())
                ->get();
            $mumbaiAll = $mumbaiAll->concat($fallback);
        }
        $mumbaiLead = $mumbaiAll->first();
        $mumbaiGrid = $mumbaiAll->slice(1, 6);

        // 6. Section 3: Ahmedabad (1 Cinematic Banner + Carousel Below)
        $ahmdCity = $cities->firstWhere('slug', 'ahmedabad');
        $ahmdAll = Article::with(['category', 'city'])
            ->published()
            ->where('city_id', $ahmdCity?->id)
            ->latest()
            ->take(6)
            ->get();
        if ($ahmdAll->count() < 6) {
            $fallback = Article::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $ahmdAll->pluck('id'))
                ->latest()
                ->take(6 - $ahmdAll->count())
                ->get();
            $ahmdAll = $ahmdAll->concat($fallback);
        }
        $ahmdBanner = $ahmdAll->first();
        $ahmdStories = $ahmdAll->slice(1);

        // 7. Section 4: Weddings & Celebrations (4-Column Collection Grid)
        $weddingArticles = Article::with(['category', 'city'])
            ->published()
            ->whereHas('category', fn($q) => $q->where('slug', 'weddings'))
            ->latest()
            ->take(4)
            ->get();
        if ($weddingArticles->count() < 4) {
            $fallback = Article::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $weddingArticles->pluck('id'))
                ->latest()
                ->take(4 - $weddingArticles->count())
                ->get();
            $weddingArticles = $weddingArticles->concat($fallback);
        }

        return view('home', compact(
            'cities',
            'coverArticle',
            'newsStrip',
            'bhavLead',
            'bhavGrid',
            'mumbaiLead',
            'mumbaiGrid',
            'ahmdBanner',
            'ahmdStories',
            'weddingArticles'
        ));
    }
}
