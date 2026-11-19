<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Person;
use Illuminate\Http\Request;

class SearchFrontendController extends Controller
{
    /**
     * Search across editorial stories and documented people.
     * Fully parameterized to guarantee protection against SQL injection.
     */
    public function search(Request $request)
    {
        $term = trim($request->input('q', ''));

        $articles = collect();
        $people = collect();

        if ($term !== '') {
            $articles = Article::with(['category', 'city'])
                ->published()
                ->where(function ($q) use ($term) {
                    $q->where('title', 'like', "%{$term}%")
                      ->orWhere('excerpt', 'like', "%{$term}%")
                      ->orWhere('author_name', 'like', "%{$term}%");
                })
                ->latest()
                ->take(15)
                ->get();

            $people = Person::with(['category', 'city'])
                ->published()
                ->where(function ($q) use ($term) {
                    $q->where('name', 'like', "%{$term}%")
                      ->orWhere('profession', 'like', "%{$term}%")
                      ->orWhere('tagline', 'like', "%{$term}%")
                      ->orWhere('organization', 'like', "%{$term}%");
                })
                ->latest()
                ->take(15)
                ->get();
        }

        return view('pages.search', compact('term', 'articles', 'people'));
    }
}
