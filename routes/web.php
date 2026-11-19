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

// ── 1. MAIN HOMEPAGE: ALL-INDIA CITYICONS PORTAL ────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ── 2. GLOBAL / MAIN SITE INFORMATION & INTERACTION ─────────────
Route::get('/about', function () {
    return view('pages.about', ['active' => 'about']);
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact', ['active' => 'contact']);
})->name('contact');

Route::get('/search', [SearchFrontendController::class, 'search'])->name('search');

Route::get('/policies/{slug?}', function ($slug = 'editorial') {
    return view('pages.policy', ['slug' => strtolower($slug)]);
})->name('policy.show');

Route::post('/nominate', [PublicNominationController::class, 'store'])->name('nominate.submit');
Route::post('/newsletter', [PublicNewsletterController::class, 'store'])->name('newsletter.submit');

// ── 3. UNIVERSAL READERS (PERSON PROFILES & ARTICLES) ───────────
Route::get('/person/{slug}', [DirectoryController::class, 'showPerson'])->name('person.show');
Route::get('/icon/{slug}', [DirectoryController::class, 'showPerson'])->name('icon.show');
Route::get('/article', [ArticleFrontendController::class, 'show'])->name('article.show.query');
Route::get('/article/{id}', [ArticleFrontendController::class, 'show'])->name('article.show');

// ── 4. CITY-SCOPED ARCHIVES (e.g. /bhavnagar/icons, /mumbai/rising, etc.) ──
Route::get('/{city}/icons', [DirectoryController::class, 'cityIcons'])->name('city.icons');
Route::get('/{city}/rising', [DirectoryController::class, 'cityRising'])->name('city.rising');
Route::get('/{city}/stories', [ArticleFrontendController::class, 'cityStories'])->name('city.stories');
Route::get('/{city}/the-list', [DirectoryController::class, 'cityTheList'])->name('city.the-list');
Route::get('/{city}/magazine', [MagazineFrontendController::class, 'cityMagazine'])->name('city.magazine');
Route::get('/{city}/nominate', [PublicNominationController::class, 'cityNominate'])->name('city.nominate');
Route::get('/{city}/featured-brands', [BrandFrontendController::class, 'cityBrands'])->name('city.brands');
Route::get('/{city}/about', function ($city) {
    $c = \App\Models\City::where('slug', strtolower($city))->first() ?: \App\Models\City::where('slug', 'bhavnagar')->first();
    return view('pages.about', ['city' => $c, 'active' => 'about']);
})->name('city.about');
Route::get('/{city}/contact', function ($city) {
    $c = \App\Models\City::where('slug', strtolower($city))->first() ?: \App\Models\City::where('slug', 'bhavnagar')->first();
    return view('pages.contact', ['city' => $c, 'active' => 'contact']);
})->name('city.contact');
Route::get('/{city}/policies/{slug?}', function ($city, $slug = 'editorial') {
    $c = \App\Models\City::where('slug', strtolower($city))->first() ?: \App\Models\City::where('slug', 'bhavnagar')->first();
    return view('pages.policy', ['city' => $c, 'slug' => strtolower($slug)]);
})->name('city.policy.show');
Route::get('/{city}/in-{targetCity}', function ($city, $targetCity, \Illuminate\Http\Request $request) {
    return app(ArticleFrontendController::class)->cityInCity($city, $request);
});
Route::get('/{city}/dispatch', [ArticleFrontendController::class, 'cityInCity'])->name('city.dispatch');

// ── 5. ADMIN PANEL ROUTES ─────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // City Switcher Workspace
        Route::get('/switch-city/{id?}', [CityController::class, 'switchCity'])->name('switch-city');

        // Articles & Stories
        Route::resource('articles', ArticleController::class);

        // People Directory (Icons, Rising Stars)
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

        // Cities (Full Edition Management)
        Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
        Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
        Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
        Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
        Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
        Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');

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

// ── 6. DIRECT ROOT-LEVEL CITY EDITIONS (e.g. /bhavnagar, /mumbai, /surat, /ahmedabad) ──
Route::get('/{city}', [CityFrontendController::class, 'show'])
    ->where('city', '[a-zA-Z0-9\-]+')
    ->name('city.show');
