<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Setting;

class BrandFrontendController extends Controller
{
    /**
     * Display Featured Brand Partners with mandatory commercial disclosures.
     */
    public function index()
    {
        $brands = Brand::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $disclosure = Setting::get('disclosure_text');

        return view('pages.featured-brands', compact('brands', 'disclosure'));
    }
}
