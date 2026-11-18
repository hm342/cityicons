<?php

use Illuminate\Support\Facades\Route;

// ── 1. MAIN HOMEPAGE (BHAVNAGAR ICONS) ────────────────────────
Route::get('/', function () {
    return view('home', ['activeCity' => 'home']);
})->name('home');

Route::get('/index.html', function () {
    return redirect()->route('home');
});

// ── 2. EDITORIAL DIRECTORY PAGES (PAGES 7 - 14) ───────────────
Route::get('/icons', function () {
    return view('pages.icons', ['active' => 'icons']);
})->name('icons');

Route::get('/rising', function () {
    return view('pages.rising', ['active' => 'rising']);
})->name('rising');

Route::get('/voices', function () {
    return view('pages.voices', ['active' => 'voices']);
})->name('voices');

Route::get('/stories', function () {
    return view('pages.stories', ['active' => 'stories']);
})->name('stories');

Route::get('/the-list', function () {
    return view('pages.the-list', ['active' => 'the-list']);
})->name('the-list');

Route::get('/magazine', function () {
    return view('pages.magazine', ['active' => 'magazine']);
})->name('magazine');

Route::get('/in-bhavnagar', function () {
    return view('pages.in-bhavnagar', ['active' => 'in-bhavnagar']);
})->name('in-bhavnagar');

Route::get('/featured-brands', function () {
    return view('pages.featured-brands', ['active' => 'featured-brands']);
})->name('featured-brands');

// ── 3. INFORMATION & INTERACTION (PAGES 15 - 17) ──────────────
Route::get('/about', function () {
    return view('pages.about', ['active' => 'about']);
})->name('about');

Route::get('/nominate', function () {
    return view('pages.nominate', ['active' => 'nominate']);
})->name('nominate');

Route::post('/nominate', function () {
    return back()->with('success', 'Thank you. Your nomination has been securely submitted for editorial review.');
});

Route::get('/contact', function () {
    return view('pages.contact', ['active' => 'contact']);
})->name('contact');

Route::get('/search', function () {
    return view('pages.search', ['active' => 'search']);
})->name('search');

// ── 4. POLICIES & STANDARDS (PAGES 18 - 31) ───────────────────
Route::get('/policies/{slug?}', function ($slug = 'editorial') {
    return view('pages.policy', ['slug' => strtolower($slug)]);
})->name('policy.show');

// ── 5. CITY EDITIONS NETWORK (MUMBAI, AHMEDABAD, ETC.) ────────
Route::get('/cities/{city}', function ($city) {
    if (strtolower($city) === 'bhavnagar') {
        return redirect()->route('home');
    }
    return view('city', ['city' => strtolower($city)]);
})->name('city.show');

Route::get('/cities/{city}.html', function ($city) {
    return redirect()->route('city.show', ['city' => $city]);
});

// ── 6. ARTICLE READING VIEW ───────────────────────────────────
Route::get('/article', function () {
    return view('article', ['articleId' => request('id')]);
})->name('article.show');

Route::get('/article/{id}', function ($id) {
    return view('article', ['articleId' => $id]);
})->whereNumber('id');

Route::get('/article.html', function () {
    return redirect()->route('article.show', ['id' => request('id')]);
});
