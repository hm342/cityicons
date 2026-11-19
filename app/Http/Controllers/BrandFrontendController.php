<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\City;
use App\Models\Setting;

class BrandFrontendController extends Controller
{
    /**
     * Display city-scoped Featured Brand Partners.
     */
    public function cityBrands($citySlug)
    {
        $city = City::where('slug', strtolower($citySlug))->first();
        if (!$city) {
            $city = City::where('slug', 'bhavnagar')->first();
        }

        $brands = Brand::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $disclosure = Setting::get('disclosure_text');

        return view('pages.featured-brands', compact('city', 'brands', 'disclosure'));
    }

    /**
     * Display Featured Brand Partners with mandatory commercial disclosures.
     */
    public function index()
    {
        return redirect('/bhavnagar/featured-brands');
    }
}
