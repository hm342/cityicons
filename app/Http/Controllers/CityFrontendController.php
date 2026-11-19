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

        // 1. Hero Cover Article / Hero Story
        $heroArticle = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->where('is_featured', true)
            ->latest()
            ->first();

        if (!$heroArticle) {
            $heroArticle = Article::with(['category', 'tags'])
                ->published()
                ->where('city_id', $city->id)
                ->latest()
                ->first();
        }

        if (!$heroArticle) {
            $heroArticle = Article::with(['category', 'tags'])
                ->published()
                ->latest()
                ->first();
        }

        // 2. Featured Icons (4 people: established professionals, creators, changemakers)
        $featuredIcons = Person::with(['category'])
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
            $moreIcons = Person::with(['category'])
                ->published()
                ->whereNotIn('id', $featuredIcons->pluck('id'))
                ->orderBy('sort_order')
                ->latest()
                ->take(4 - $featuredIcons->count())
                ->get();
            $featuredIcons = $featuredIcons->concat($moreIcons);
        }

        // 3. Rising (4 emerging individuals building what comes next)
        $risingPeople = Person::with(['category'])
            ->published()
            ->where('city_id', $city->id)
            ->where('type', 'rising')
            ->orderBy('sort_order')
            ->latest()
            ->take(4)
            ->get();

        if ($risingPeople->count() < 4) {
            $moreRising = Person::with(['category'])
                ->published()
                ->where('type', 'rising')
                ->whereNotIn('id', $risingPeople->pluck('id'))
                ->orderBy('sort_order')
                ->latest()
                ->take(4 - $risingPeople->count())
                ->get();
            $risingPeople = $risingPeople->concat($moreRising);
        }

        if ($risingPeople->count() < 4) {
            $fallbackRising = Person::with(['category'])
                ->published()
                ->whereNotIn('id', array_merge($featuredIcons->pluck('id')->toArray(), $risingPeople->pluck('id')->toArray()))
                ->orderBy('sort_order')
                ->take(4 - $risingPeople->count())
                ->get();
            $risingPeople = $risingPeople->concat($fallbackRising);
        }

        // 4. Voices (4 conversation profiles / reflections)
        $voicesPeople = Person::with(['category'])
            ->published()
            ->where('city_id', $city->id)
            ->where('type', 'voice')
            ->orderBy('sort_order')
            ->latest()
            ->take(4)
            ->get();

        if ($voicesPeople->count() < 4) {
            $moreVoices = Person::with(['category'])
                ->published()
                ->where('type', 'voice')
                ->whereNotIn('id', $voicesPeople->pluck('id'))
                ->orderBy('sort_order')
                ->latest()
                ->take(4 - $voicesPeople->count())
                ->get();
            $voicesPeople = $voicesPeople->concat($moreVoices);
        }

        if ($voicesPeople->count() < 4) {
            $fallbackVoices = Person::with(['category'])
                ->published()
                ->whereNotIn('id', array_merge($featuredIcons->pluck('id')->toArray(), $risingPeople->pluck('id')->toArray(), $voicesPeople->pluck('id')->toArray()))
                ->orderBy('sort_order')
                ->take(4 - $voicesPeople->count())
                ->get();
            $voicesPeople = $voicesPeople->concat($fallbackVoices);
        }

        // 5. Stories (4 long-form profiles, city stories and editorial features)
        $stories = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->whereNotIn('id', $heroArticle ? [$heroArticle->id] : [])
            ->latest()
            ->take(4)
            ->get();

        if ($stories->count() < 4) {
            $moreStories = Article::with(['category', 'tags'])
                ->published()
                ->whereNotIn('id', array_merge($heroArticle ? [$heroArticle->id] : [], $stories->pluck('id')->toArray()))
                ->latest()
                ->take(4 - $stories->count())
                ->get();
            $stories = $stories->concat($moreStories);
        }

        // 6. The List (Monthly archive preview: names presented alphabetically)
        $listPeople = Person::with(['category'])
            ->published()
            ->where('city_id', $city->id)
            ->orderBy('name', 'asc')
            ->take(8)
            ->get();

        if ($listPeople->isEmpty()) {
            $listPeople = Person::with(['category'])
                ->published()
                ->orderBy('name', 'asc')
                ->take(8)
                ->get();
        }

        // 7. Magazine Edition (Latest curated digital magazine)
        $magazine = MagazineEdition::where('is_active', true)->latest()->first() ?: MagazineEdition::latest()->first();

        // 8. In Bhavnagar / In [City] (Selective coverage of events, exhibitions, cultural moments)
        $inCityStories = Article::with(['category', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->whereHas('category', function ($q) {
                $q->whereIn('slug', ['events', 'culture', 'places', 'dispatch', 'in-city']);
            })
            ->latest()
            ->take(4)
            ->get();

        if ($inCityStories->count() < 4) {
            $fallbackInCity = Article::with(['category', 'tags'])
                ->published()
                ->where('city_id', $city->id)
                ->whereNotIn('id', $inCityStories->pluck('id'))
                ->latest()
                ->take(4 - $inCityStories->count())
                ->get();
            $inCityStories = $inCityStories->concat($fallbackInCity);
        }

        if ($inCityStories->count() < 4) {
            $natInCity = Article::with(['category', 'tags'])
                ->published()
                ->whereNotIn('id', $inCityStories->pluck('id'))
                ->latest()
                ->take(4 - $inCityStories->count())
                ->get();
            $inCityStories = $inCityStories->concat($natInCity);
        }

        // 9. Featured Brands (Credible brands & clearly disclosed collaborations)
        $brands = Brand::where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('city', compact(
            'city',
            'cityId',
            'cityName',
            'heroArticle',
            'featuredIcons',
            'risingPeople',
            'voicesPeople',
            'stories',
            'listPeople',
            'magazine',
            'inCityStories',
            'brands'
        ));
    }
}
