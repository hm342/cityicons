<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::withCount(['articles', 'people'])->orderBy('sort_order')->get();
        return view('admin.cities.index', compact('cities'));
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
            'state'           => ['required', 'string', 'max:255'],
            'tagline'         => ['nullable', 'string', 'max:255'],
            'hero_image_file' => ['nullable', 'image', 'max:5120'],
            'hero_image_url'  => ['nullable', 'url'],
            'accent_color'    => ['required', 'string', 'max:7'],
            'is_active'       => ['boolean'],
            'sort_order'      => ['nullable', 'integer'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('hero_image_file')) {
            $path = $request->file('hero_image_file')->store('cities', 'public');
            $validated['hero_image'] = '/storage/' . $path;
        } elseif ($request->filled('hero_image_url')) {
            $validated['hero_image'] = $request->hero_image_url;
        }

        unset($validated['hero_image_file'], $validated['hero_image_url']);

        $city->update($validated);

        \Illuminate\Support\Facades\Cache::forget('active_cities');

        return redirect()->route('admin.cities.index')->with('success', 'City edition updated successfully.');
    }
}
