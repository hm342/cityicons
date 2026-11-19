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

        // Query people in selected month/year, ordered alphabetically
        $entries = Person::with(['category', 'city'])
            ->published()
            ->where('year', $selectedYear)
            ->where('month', $selectedMonth)
            ->orderBy('name', 'asc')
            ->get();

        return view('pages.the-list', compact(
            'entries',
            'selectedYear',
            'selectedMonth',
            'availableArchives'
        ));
    }
}
