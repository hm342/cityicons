<?php

use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\ArticleFrontendController;
use App\Http\Controllers\MagazineFrontendController;
use App\Http\Controllers\BrandFrontendController;
use App\Http\Controllers\CityFrontendController;
use App\Http\Controllers\SearchFrontendController;
use App\Http\Controllers\PublicNominationController;
use App\Http\Controllers\PublicNewsletterController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\NominationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\MagazineEditionController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SettingController;

// ── 1. MAIN HOMEPAGE (BHAVNAGAR ICONS) ────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/index.html', function () {
    return redirect()->route('home');
});

// ── 2. EDITORIAL DIRECTORY PAGES (PAGES 7 - 14) ───────────────
Route::get('/icons', [DirectoryController::class, 'icons'])->name('icons');
Route::get('/rising', [DirectoryController::class, 'rising'])->name('rising');
Route::get('/voices', [DirectoryController::class, 'voices'])->name('voices');
Route::get('/stories', [ArticleFrontendController::class, 'stories'])->name('stories');
Route::get('/the-list', [DirectoryController::class, 'theList'])->name('the-list');
Route::get('/magazine', [MagazineFrontendController::class, 'index'])->name('magazine');
Route::get('/in-bhavnagar', [ArticleFrontendController::class, 'inBhavnagar'])->name('in-bhavnagar');
Route::get('/featured-brands', [BrandFrontendController::class, 'index'])->name('featured-brands');

// ── 3. INFORMATION & INTERACTION (PAGES 15 - 17) ──────────────
Route::get('/about', function () {
    return view('pages.about', ['active' => 'about']);
})->name('about');

Route::get('/nominate', function () {
    return view('pages.nominate', ['active' => 'nominate']);
})->name('nominate');

Route::post('/nominate', [PublicNominationController::class, 'store'])->name('nominate.submit');
Route::post('/newsletter', [PublicNewsletterController::class, 'store'])->name('newsletter.submit');

Route::get('/contact', function () {
    return view('pages.contact', ['active' => 'contact']);
})->name('contact');

Route::get('/search', [SearchFrontendController::class, 'search'])->name('search');

// ── 4. POLICIES & STANDARDS (PAGES 18 - 31) ───────────────────
Route::get('/policies/{slug?}', function ($slug = 'editorial') {
    return view('pages.policy', ['slug' => strtolower($slug)]);
})->name('policy.show');

// ── 5. CITY EDITIONS NETWORK (MUMBAI, AHMEDABAD, ETC.) ────────
Route::get('/cities/{city}', [CityFrontendController::class, 'show'])->name('city.show');

Route::get('/cities/{city}.html', function ($city) {
    return redirect()->route('city.show', ['city' => $city]);
});

// ── 6. ARTICLE READING VIEW ───────────────────────────────────
Route::get('/article', [ArticleFrontendController::class, 'show'])->name('article.show.query');
Route::get('/article/{id}', [ArticleFrontendController::class, 'show'])->name('article.show');

Route::get('/article.html', function () {
    return redirect()->route('article.show', ['id' => request('id')]);
});

// ── 7. ADMIN PANEL ROUTES ─────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Articles & Stories
        Route::resource('articles', ArticleController::class);

        // People Directory (Icons, Rising Stars, Voices)
        Route::resource('people', PersonController::class);

        // Nominations
        Route::get('/nominations', [NominationController::class, 'index'])->name('nominations.index');
        Route::get('/nominations/{id}', [NominationController::class, 'show'])->name('nominations.show');
        Route::post('/nominations/{id}/status', [NominationController::class, 'updateStatus'])->name('nominations.status');
        Route::post('/nominations/{id}/convert', [NominationController::class, 'convertToPerson'])->name('nominations.convert');
        Route::delete('/nominations/{id}', [NominationController::class, 'destroy'])->name('nominations.destroy');

        // Categories & Tags
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
        Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
        Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');

        // Cities
        Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
        Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
        Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');

        // Brands (Featured Partners)
        Route::resource('brands', BrandController::class);

        // Magazine Editions
        Route::resource('magazine-editions', MagazineEditionController::class);

        // Subscribers
        Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
        Route::get('/subscribers/export', [SubscriberController::class, 'export'])->name('subscribers.export');
        Route::delete('/subscribers/{id}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

        // Site Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
