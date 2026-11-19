<?php

namespace App\Http\Controllers;

use App\Models\MagazineEdition;
use App\Models\City;

class MagazineFrontendController extends Controller
{
    /**
     * Display city-scoped Magazine showcase & archive.
     */
    public function cityMagazine($citySlug)
    {
        $city = City::where('slug', strtolower($citySlug))->first();
        if (!$city) {
            $city = City::where('slug', 'bhavnagar')->first();
        }

        $editions = MagazineEdition::where('is_active', true)
            ->orderBy('issue_number', 'desc')
            ->get();

        $currentIssue = $editions->first();
        $previousIssues = $editions->slice(1);

        return view('pages.magazine', compact('city', 'currentIssue', 'previousIssues'));
    }

    /**
     * Display Magazine showcase & archive from MySQL.
     */
    public function index()
    {
        return redirect('/bhavnagar/magazine');
    }
}
