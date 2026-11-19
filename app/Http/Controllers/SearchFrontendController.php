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
                ->take(12)
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
                ->take(12)
                ->get();
        }

        // Live JSON response for search modal
        if ($request->wantsJson() || $request->has('json')) {
            return response()->json([
                'articles' => $articles->map(fn($a) => [
                    'id' => $a->id,
                    'title' => $a->title,
                    'category' => $a->category->name ?? 'Story',
                    'city' => $a->city->name ?? null,
                    'image' => $a->cover_image,
                    'url' => url('/article/' . $a->id),
                ]),
                'people' => $people->map(fn($p) => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'profession' => $p->profession,
                    'category' => $p->category->name ?? strtoupper($p->type),
                    'image' => $p->portrait_image ?: $p->cover_image,
                    'url' => url('/stories'),
                ]),
            ]);
        }

        return view('pages.search', compact('term', 'articles', 'people'));
    }
}
