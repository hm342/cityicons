<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::withCount(['articles', 'people'])->orderBy('sort_order')->get();
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'slug'            => ['nullable', 'string', 'max:255', 'unique:cities,slug'],
            'state'           => ['required', 'string', 'max:255'],
            'tagline'         => ['nullable', 'string', 'max:255'],
            'hero_image_file' => ['nullable', 'image', 'max:5120'],
            'hero_image_url'  => ['nullable', 'url'],
            'accent_color'    => ['nullable', 'string', 'max:7'],
            'is_active'       => ['boolean'],
            'sort_order'      => ['nullable', 'integer'],
        ]);

        $validated['slug'] = !empty($validated['slug']) 
            ? Str::slug($validated['slug']) 
            : Str::slug($validated['name']);

        $validated['accent_color'] = $validated['accent_color'] ?: '#E50914';
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? (City::max('sort_order') + 1);

        if ($request->hasFile('hero_image_file')) {
            $path = $request->file('hero_image_file')->store('cities', 'public');
            $validated['hero_image'] = '/storage/' . $path;
        } elseif ($request->filled('hero_image_url')) {
            $validated['hero_image'] = $request->hero_image_url;
        } else {
            $validated['hero_image'] = 'https://images.unsplash.com/photo-1596401057633-54a8fe8ef647?auto=format&fit=crop&w=1600&q=80';
        }

        unset($validated['hero_image_file'], $validated['hero_image_url']);

        $city = City::create($validated);

        Cache::forget('active_cities');
        Cache::forget('active_cities_nav');

        return redirect()->route('admin.cities.index')->with('success', "City edition {$city->name} added successfully.");
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'slug'            => ['nullable', 'string', 'max:255', 'unique:cities,slug,' . $id],
            'state'           => ['required', 'string', 'max:255'],
            'tagline'         => ['nullable', 'string', 'max:255'],
            'hero_image_file' => ['nullable', 'image', 'max:5120'],
            'hero_image_url'  => ['nullable', 'url'],
            'accent_color'    => ['required', 'string', 'max:7'],
            'is_active'       => ['boolean'],
            'sort_order'      => ['nullable', 'integer'],
        ]);

        if (!empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('hero_image_file')) {
            $path = $request->file('hero_image_file')->store('cities', 'public');
            $validated['hero_image'] = '/storage/' . $path;
        } elseif ($request->filled('hero_image_url')) {
            $validated['hero_image'] = $request->hero_image_url;
        }

        unset($validated['hero_image_file'], $validated['hero_image_url']);

        $city->update($validated);

        Cache::forget('active_cities');
        Cache::forget('active_cities_nav');

        return redirect()->route('admin.cities.index')->with('success', 'City edition updated successfully.');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);

        if ($city->slug === 'bhavnagar') {
            return redirect()->route('admin.cities.index')->with('error', 'The Bhavnagar flagship edition cannot be deleted.');
        }

        // Unlink or nullify associated records
        $city->articles()->update(['city_id' => null]);
        $city->people()->update(['city_id' => null]);
        if (method_exists($city, 'brands')) {
            $city->brands()->update(['city_id' => null]);
        }

        // If this was the active admin city, clear session
        if (session('admin_city_id') == $city->id) {
            session()->forget('admin_city_id');
        }

        $cityName = $city->name;
        $city->delete();

        Cache::forget('active_cities');
        Cache::forget('active_cities_nav');

        return redirect()->route('admin.cities.index')->with('success', "City edition {$cityName} deleted successfully.");
    }

    public function switchCity($id = null)
    {
        if (empty($id) || $id === 'all') {
            session()->forget('admin_city_id');
            return redirect()->back()->with('success', 'Switched to National / All Cities view.');
        }

        $city = City::findOrFail($id);
        session(['admin_city_id' => $city->id]);

        return redirect()->back()->with('success', "Active workspace switched to {$city->name} Icons.");
    }
}
