<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Person;
use App\Models\Nomination;
use App\Models\Subscriber;
use App\Models\City;

class DashboardController extends Controller
{
    public function index()
    {
        $cityId = session('admin_city_id');

        $articlesQuery = Article::query();
        $peopleQuery = Person::query();
        $nominationsQuery = Nomination::query();

        if ($cityId) {
            $articlesQuery->where('city_id', $cityId);
            $peopleQuery->where('city_id', $cityId);
            $activeCity = City::find($cityId);
            if ($activeCity) {
                $nominationsQuery->where('nominee_city', 'like', "%{$activeCity->name}%");
            }
        }

        $stats = [
            'articles_count'      => (clone $articlesQuery)->count(),
            'published_articles'  => (clone $articlesQuery)->where('status', 'published')->count(),
            'people_count'        => (clone $peopleQuery)->count(),
            'icons_count'         => (clone $peopleQuery)->where(function ($q) {
                $q->where('type', 'icon')->orWhereNull('type');
            })->count(),
            'rising_count'        => (clone $peopleQuery)->where('type', 'rising')->count(),
            'nominations_count'   => (clone $nominationsQuery)->count(),
            'pending_nominations' => (clone $nominationsQuery)->where('status', 'pending')->count(),
            'subscribers_count'   => Subscriber::where('is_active', true)->count(),
            'cities_count'        => City::where('is_active', true)->count(),
        ];

        $recentArticles = (clone $articlesQuery)->with(['category', 'city'])
            ->latest()
            ->take(6)
            ->get();

        $recentNominations = (clone $nominationsQuery)->latest('submitted_at')
            ->take(6)
            ->get();

        $recentSubscribers = Subscriber::latest('subscribed_at')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentNominations', 'recentSubscribers'));
    }
}
