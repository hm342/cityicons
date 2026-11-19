<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\Paginator;
use App\Models\City;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Global clean pagination default across frontend and admin
        Paginator::defaultView('vendor.pagination.default');
        Paginator::defaultSimpleView('vendor.pagination.simple-default');

        // 1. Share dynamic active cities with frontend components (Drawer, Footer, City Navbar, etc.)
        View::composer(['components.drawer', 'components.footer', 'components.city-navbar', 'home', 'pages.*', 'city'], function ($view) {
            $navCities = City::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
            $view->with('navCities', $navCities);
        });

        // 2. Share global admin cities and active switched city with Admin layouts and views
        View::composer(['layouts.admin', 'admin.*'], function ($view) {
            $globalAdminCities = City::orderBy('sort_order')->orderBy('name')->get();
            $activeAdminCityId = session('admin_city_id');
            $activeAdminCity = $activeAdminCityId ? City::find($activeAdminCityId) : null;
            $view->with('globalAdminCities', $globalAdminCities)
                 ->with('activeAdminCity', $activeAdminCity);
        });
    }
}
