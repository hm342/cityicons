<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    /**
     * Display City-scoped Icons Directory (e.g. /bhavnagar/icons).
     */
    public function cityIcons($citySlug, Request $request)
    {
        $city = City::where('slug', strtolower($citySlug))->first();
        if (!$city) {
            $city = City::where('slug', 'bhavnagar')->firstOrFail();
        }

        $categories = Category::orderBy('name')->get();

        $query = Person::with(['category', 'city', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->icons()
            ->orderBy('sort_order')
            ->latest();

        if ($request->filled('category')) {
            $catSlug = $request->category;
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        $people = $query->paginate(12)->withQueryString();
        if ($people->isEmpty() && !$request->filled('category')) {
            $people = Person::with(['category', 'city', 'tags'])
                ->published()
                ->icons()
                ->orderBy('sort_order')
                ->latest()
                ->paginate(12);
        }
        $lead = $people->first();

        return view('pages.icons', compact('city', 'people', 'lead', 'categories'));
    }

    /**
     * Fallback redirect for /icons -> /bhavnagar/icons
     */
    public function icons(Request $request)
    {
        return redirect('/bhavnagar/icons' . ($request->getQueryString() ? '?' . $request->getQueryString() : ''));
    }

    /**
     * Display City-scoped Rising Stars Directory (e.g. /bhavnagar/rising).
     */
    public function cityRising($citySlug, Request $request)
    {
        $city = City::where('slug', strtolower($citySlug))->first();
        if (!$city) {
            $city = City::where('slug', 'bhavnagar')->firstOrFail();
        }

        $categories = Category::orderBy('name')->get();

        $query = Person::with(['category', 'city', 'tags'])
            ->published()
            ->where('city_id', $city->id)
            ->rising()
            ->orderBy('sort_order')
            ->latest();

        if ($request->filled('category')) {
            $catSlug = $request->category;
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        $people = $query->paginate(12)->withQueryString();
        if ($people->isEmpty() && !$request->filled('category')) {
            $people = Person::with(['category', 'city', 'tags'])
                ->published()
                ->rising()
                ->orderBy('sort_order')
                ->latest()
                ->paginate(12);
        }
        $lead = $people->first();

        return view('pages.rising', compact('city', 'people', 'lead', 'categories'));
    }

    /**
     * Fallback redirect for /rising -> /bhavnagar/rising
     */
    public function rising(Request $request)
    {
        return redirect('/bhavnagar/rising' . ($request->getQueryString() ? '?' . $request->getQueryString() : ''));
    }

    /**
     * Voices page removal: redirect to Icons
     */
    public function voices(Request $request)
    {
        return redirect('/bhavnagar/icons');
    }

    /**
     * Display City-scoped The List monthly archive (e.g. /bhavnagar/the-list).
     */
    public function cityTheList($citySlug, Request $request)
    {
        $city = City::where('slug', strtolower($citySlug))->first();
        if (!$city) {
            $city = City::where('slug', 'bhavnagar')->firstOrFail();
        }

        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        $selectedYear = (int) $request->input('year', $currentYear);
        $selectedMonth = (int) $request->input('month', $currentMonth);

        // Fetch distinct available archives for this city
        $availableArchives = Person::published()
            ->where('city_id', $city->id)
            ->whereNotNull('year')
            ->whereNotNull('month')
            ->select('year', 'month')
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $query = Person::with(['category', 'city'])
            ->published()
            ->where('city_id', $city->id)
            ->where('year', $selectedYear)
            ->where('month', $selectedMonth)
            ->orderBy('name', 'asc');

        $entries = $query->get();

        if ($entries->isEmpty()) {
            $entries = Person::with(['category', 'city'])
                ->published()
                ->where('city_id', $city->id)
                ->orderBy('name', 'asc')
                ->take(12)
                ->get();
        }

        return view('pages.the-list', compact(
            'city',
            'entries',
            'selectedYear',
            'selectedMonth',
            'availableArchives'
        ));
    }

    /**
     * Fallback redirect for /the-list -> /bhavnagar/the-list
     */
    public function theList(Request $request)
    {
        return redirect('/bhavnagar/the-list' . ($request->getQueryString() ? '?' . $request->getQueryString() : ''));
    }

    /**
     * Display dedicated profile page for an Icon / Person.
     */
    public function showPerson($slug)
    {
        $person = Person::with(['category', 'city', 'tags'])
            ->published()
            ->where(function ($q) use ($slug) {
                $q->where('slug', $slug)->orWhere('id', $slug);
            })
            ->firstOrFail();

        // Related stories (articles that share category or city)
        $relatedArticles = \App\Models\Article::with(['category', 'city'])
            ->published()
            ->when($person->category_id, function ($q) use ($person) {
                $q->where('category_id', $person->category_id);
            })
            ->latest()
            ->take(3)
            ->get();

        // More profiles in same category or tier
        $morePeople = Person::with(['category', 'city'])
            ->published()
            ->where('id', '!=', $person->id)
            ->where('type', $person->type)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.person', compact('person', 'relatedArticles', 'morePeople'));
    }
}
