<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Article;
use App\Models\Person;
use App\Models\Brand;
use App\Models\MagazineEdition;

class CityFrontendController extends Controller
{
    /**
     * Display the City Home Page (Matching PDF Pages 4, 5, 6 Editorial Blueprint).
     */
    public function show($slug)
    {
        $city = City::where('slug', strtolower($slug))->firstOrFail();
        $cityId = $city->slug;
        $cityName = $city->name;

        // 1. Hero Slides (Up to 3 featured articles for Real Moments slider)
        $heroSlides = Article::with(['category', 'tags', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        if ($heroSlides->count() < 3) {
            $moreSlides = Article::with(['category', 'tags', 'city'])
                ->published()
                ->where('city_id', $city->id)
                ->whereNotIn('id', $heroSlides->pluck('id'))
                ->latest()
                ->take(3 - $heroSlides->count())
                ->get();
            $heroSlides = $heroSlides->concat($moreSlides);
        }

        if ($heroSlides->isEmpty()) {
            $heroSlides = Article::with(['category', 'tags', 'city'])
                ->published()
                ->latest()
                ->take(3)
                ->get();
        }

        $heroArticle = $heroSlides->first();

        // 2. Featured Icons (5 items for 2 stacked left + 1 tall center + 2 stacked right collage)
        $featuredIcons = Person::with(['category', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->where(function ($q) {
                $q->where('type', 'icon')->orWhereNull('type');
            })
            ->orderBy('sort_order')
            ->latest()
            ->take(5)
            ->get();

        if ($featuredIcons->count() < 5) {
            $moreIcons = Person::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $featuredIcons->pluck('id'))
                ->orderBy('sort_order')
                ->latest()
                ->take(5 - $featuredIcons->count())
                ->get();
            $featuredIcons = $featuredIcons->concat($moreIcons);
        }

        // 3. Rising (5 items for 1 tall left + 4 right 2x2 collage)
        $risingPeople = Person::with(['category', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->where('type', 'rising')
            ->orderBy('sort_order')
            ->latest()
            ->take(5)
            ->get();

        if ($risingPeople->count() < 5) {
            $excludeIds = array_merge($featuredIcons->pluck('id')->toArray(), $risingPeople->pluck('id')->toArray());
            $moreRising = Person::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $excludeIds)
                ->orderBy('sort_order')
                ->latest()
                ->take(5 - $risingPeople->count())
                ->get();
            $risingPeople = $risingPeople->concat($moreRising);
        }

        // 4. Stories (5 items for 2 top asymmetric + 3 bottom equal collage)
        $excludeArticleIds = $heroArticle ? [$heroArticle->id] : [];
        $stories = Article::with(['category', 'tags', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->whereNotIn('id', $excludeArticleIds)
            ->latest()
            ->take(5)
            ->get();

        if ($stories->count() < 5) {
            $moreStories = Article::with(['category', 'tags', 'city'])
                ->published()
                ->whereNotIn('id', array_merge($excludeArticleIds, $stories->pluck('id')->toArray()))
                ->latest()
                ->take(5 - $stories->count())
                ->get();
            $stories = $stories->concat($moreStories);
        }

        // 5. The List (Monthly archive preview: names presented alphabetically)
        $listPeople = Person::with(['category', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->orderBy('name', 'asc')
            ->take(6)
            ->get();

        if ($listPeople->isEmpty()) {
            $listPeople = Person::with(['category', 'city'])
                ->published()
                ->orderBy('name', 'asc')
                ->take(6)
                ->get();
        }

        // 6. Magazine Edition (City-scoped digital magazine with fallback)
        $magazine = MagazineEdition::where('is_active', true)->where('city_id', $city->id)->latest()->first() 
            ?? MagazineEdition::where('is_active', true)->latest()->first();

        // 7. In [City] (6 items for 3x2 vertical cards grid)
        $inCityStories = Article::with(['category', 'tags', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->whereHas('category', function ($q) {
                $q->whereIn('slug', ['events', 'culture', 'places', 'dispatch', 'in-city']);
            })
            ->latest()
            ->take(6)
            ->get();

        if ($inCityStories->count() < 6) {
            $moreInCity = Article::with(['category', 'tags', 'city'])
                ->published()
                ->whereNotIn('id', $inCityStories->pluck('id'))
                ->latest()
                ->take(6 - $inCityStories->count())
                ->get();
            $inCityStories = $inCityStories->concat($moreInCity);
        }

        // 8. Featured Brands (Credible brands & clearly disclosed collaborations)
        $brands = Brand::where('is_active', true)
            ->where(function ($q) use ($city) {
                $q->where('city_id', $city->id)->orWhereNull('city_id');
            })
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('city', compact(
            'city',
            'cityId',
            'cityName',
            'heroArticle',
            'heroSlides',
            'featuredIcons',
            'risingPeople',
            'stories',
            'listPeople',
            'magazine',
            'inCityStories',
            'brands'
        ));
    }
}
