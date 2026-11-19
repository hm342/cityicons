<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Category;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    /**
     * Display Icons Directory with eager loaded relations.
     */
    public function icons(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Person::with(['category', 'city', 'tags'])
            ->published()
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
        $lead = $people->first();

        return view('pages.icons', compact('people', 'lead', 'categories'));
    }

    /**
     * Display Rising Stars Directory with eager loaded relations.
     */
    public function rising(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Person::with(['category', 'city', 'tags'])
            ->published()
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
        $lead = $people->first();

        return view('pages.rising', compact('people', 'lead', 'categories'));
    }

    /**
     * Display Voices Directory with eager loaded relations.
     */
    public function voices(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Person::with(['category', 'city', 'tags'])
            ->published()
            ->voices()
            ->orderBy('sort_order')
            ->latest();

        if ($request->filled('category')) {
            $catSlug = $request->category;
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        $people = $query->paginate(12)->withQueryString();

        return view('pages.voices', compact('people', 'categories'));
    }

    /**
     * Display The List monthly archive.
     */
    public function theList(Request $request)
    {
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        $selectedYear = (int) $request->input('year', $currentYear);
        $selectedMonth = (int) $request->input('month', $currentMonth);

        // Fetch distinct available archives
        $availableArchives = Person::published()
            ->whereNotNull('year')
            ->whereNotNull('month')
            ->select('year', 'month')
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Query people for the specific month/year
        $query = Person::with(['category', 'city'])
            ->published()
            ->where('year', $selectedYear)
            ->where('month', $selectedMonth)
            ->orderBy('name', 'asc');

        $entries = $query->get();

        // If no records for selected date, fetch any recent entries so page is never completely empty
        if ($entries->isEmpty()) {
            $entries = Person::with(['category', 'city'])
                ->published()
                ->orderBy('name', 'asc')
                ->take(12)
                ->get();
        }

        return view('pages.the-list', compact(
            'entries',
            'selectedYear',
            'selectedMonth',
            'availableArchives'
        ));
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

