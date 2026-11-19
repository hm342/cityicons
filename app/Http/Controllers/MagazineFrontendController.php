<?php

namespace App\Http\Controllers;

use App\Models\MagazineEdition;

class MagazineFrontendController extends Controller
{
    /**
     * Display Magazine showcase & archive from MySQL.
     */
    public function index()
    {
        $editions = MagazineEdition::where('is_active', true)
            ->orderBy('issue_number', 'desc')
            ->get();

        $currentIssue = $editions->first();
        $previousIssues = $editions->slice(1);

        return view('pages.magazine', compact('currentIssue', 'previousIssues'));
    }
}
