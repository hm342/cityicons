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

        // 2. Featured Icons (4 people: established professionals, creators, changemakers)
        $featuredIcons = Person::with(['category', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->where(function ($q) {
                $q->where('type', 'icon')->orWhereNull('type');
            })
            ->orderBy('sort_order')
            ->latest()
            ->take(4)
            ->get();

        if ($featuredIcons->count() < 4) {
            $moreIcons = Person::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $featuredIcons->pluck('id'))
                ->orderBy('sort_order')
                ->latest()
                ->take(4 - $featuredIcons->count())
                ->get();
            $featuredIcons = $featuredIcons->concat($moreIcons);
        }

        // 3. Rising (4 emerging individuals building what comes next)
        $risingPeople = Person::with(['category', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->where('type', 'rising')
            ->orderBy('sort_order')
            ->latest()
            ->take(4)
            ->get();

        if ($risingPeople->count() < 4) {
            $excludeIds = array_merge($featuredIcons->pluck('id')->toArray(), $risingPeople->pluck('id')->toArray());
            $moreRising = Person::with(['category', 'city'])
                ->published()
                ->whereNotIn('id', $excludeIds)
                ->orderBy('sort_order')
                ->latest()
                ->take(4 - $risingPeople->count())
                ->get();
            $risingPeople = $risingPeople->concat($moreRising);
        }

        // 4. Stories (4 long-form profiles, city stories and editorial features)
        $excludeArticleIds = $heroArticle ? [$heroArticle->id] : [];
        $stories = Article::with(['category', 'tags', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->whereNotIn('id', $excludeArticleIds)
            ->latest()
            ->take(4)
            ->get();

        if ($stories->count() < 4) {
            $moreStories = Article::with(['category', 'tags', 'city'])
                ->published()
                ->whereNotIn('id', array_merge($excludeArticleIds, $stories->pluck('id')->toArray()))
                ->latest()
                ->take(4 - $stories->count())
                ->get();
            $stories = $stories->concat($moreStories);
        }

        // 5. The List (Monthly archive preview: names presented alphabetically)
        $listPeople = Person::with(['category', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->orderBy('name', 'asc')
            ->take(8)
            ->get();

        if ($listPeople->isEmpty()) {
            $listPeople = Person::with(['category', 'city'])
                ->published()
                ->orderBy('name', 'asc')
                ->take(8)
                ->get();
        }

        // 6. Magazine Edition (Latest curated digital magazine)
        $magazine = MagazineEdition::where('is_active', true)->latest()->first() 
            ?? MagazineEdition::latest()->first();

        // 7. In [City] (Selective coverage of events, exhibitions, cultural moments)
        $inCityStories = Article::with(['category', 'tags', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->whereHas('category', function ($q) {
                $q->whereIn('slug', ['events', 'culture', 'places', 'dispatch', 'in-city']);
            })
            ->latest()
            ->take(4)
            ->get();

        if ($inCityStories->count() < 4) {
            $moreInCity = Article::with(['category', 'tags', 'city'])
                ->published()
                ->whereNotIn('id', $inCityStories->pluck('id'))
                ->latest()
                ->take(4 - $inCityStories->count())
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
