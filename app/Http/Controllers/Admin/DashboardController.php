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
        $stats = [
            'articles_count'     => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'people_count'       => Person::count(),
            'icons_count'        => Person::where('type', 'icon')->count(),
            'rising_count'       => Person::where('type', 'rising')->count(),
            'voices_count'       => Person::where('type', 'voice')->count(),
            'nominations_count'  => Nomination::count(),
            'pending_nominations'=> Nomination::where('status', 'pending')->count(),
            'subscribers_count'  => Subscriber::where('is_active', true)->count(),
            'cities_count'       => City::where('is_active', true)->count(),
        ];

        $recentArticles = Article::with(['category', 'city'])
            ->latest()
            ->take(6)
            ->get();

        $recentNominations = Nomination::latest('submitted_at')
            ->take(6)
            ->get();

        $recentSubscribers = Subscriber::latest('subscribed_at')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentNominations', 'recentSubscribers'));
    }
}
