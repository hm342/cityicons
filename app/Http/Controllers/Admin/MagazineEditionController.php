<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MagazineEdition;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MagazineEditionController extends Controller
{
    public function index()
    {
        $activeCityId = session('admin_city_id');
        $query = MagazineEdition::with('city')->orderBy('issue_number', 'desc');

        if ($activeCityId) {
            $query->where('city_id', $activeCityId);
        }

        $editions = $query->get();
        return view('admin.magazine-editions.index', compact('editions', 'activeCityId'));
    }

    public function create()
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $selectedCityId = session('admin_city_id');
        return view('admin.magazine-editions.create', compact('cities', 'selectedCityId'));
    }

    public function store(Request $request)
    {
        $activeCityId = session('admin_city_id');
        $cityId = $activeCityId ?: $request->input('city_id');

        $validated = $request->validate([
            'city_id'          => [$activeCityId ? 'nullable' : 'required', 'exists:cities,id'],
            'issue_number'     => [
                'required',
                'integer',
                Rule::unique('magazine_editions', 'issue_number')->where(function ($query) use ($cityId) {
                    return $query->where('city_id', $cityId);
                }),
            ],
            'title'            => ['required', 'string', 'max:255'],
            'cover_image_file' => ['nullable', 'image', 'max:5120'],
            'cover_image_url'  => ['nullable', 'url'],
            'description'      => ['nullable', 'string'],
            'published_date'   => ['nullable', 'date'],
            'is_active'        => ['boolean'],
        ]);

        $validated['city_id'] = $cityId;
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('magazine', 'public');
            $validated['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $validated['cover_image'] = $request->cover_image_url;
        }

        unset($validated['cover_image_file'], $validated['cover_image_url']);

        MagazineEdition::create($validated);

        return redirect()->route('admin.magazine-editions.index')->with('success', 'Magazine edition published.');
    }

    public function edit($id)
    {
        $edition = MagazineEdition::with('city')->findOrFail($id);
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $selectedCityId = $edition->city_id;
        return view('admin.magazine-editions.edit', compact('edition', 'cities', 'selectedCityId'));
    }

    public function update(Request $request, $id)
    {
        $edition = MagazineEdition::findOrFail($id);
        $activeCityId = session('admin_city_id');
        $cityId = $activeCityId ?: ($request->input('city_id') ?: $edition->city_id);

        $validated = $request->validate([
            'city_id'          => ['nullable', 'exists:cities,id'],
            'issue_number'     => [
                'required',
                'integer',
                Rule::unique('magazine_editions', 'issue_number')->where(function ($query) use ($cityId) {
                    return $query->where('city_id', $cityId);
                })->ignore($edition->id),
            ],
            'title'            => ['required', 'string', 'max:255'],
            'cover_image_file' => ['nullable', 'image', 'max:5120'],
            'cover_image_url'  => ['nullable', 'url'],
            'description'      => ['nullable', 'string'],
            'published_date'   => ['nullable', 'date'],
            'is_active'        => ['boolean'],
        ]);

        if ($cityId) {
            $validated['city_id'] = $cityId;
        }

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('magazine', 'public');
            $validated['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $validated['cover_image'] = $request->cover_image_url;
        }

        unset($validated['cover_image_file'], $validated['cover_image_url']);

        $edition->update($validated);

        return redirect()->route('admin.magazine-editions.index')->with('success', 'Magazine edition updated.');
    }

    public function destroy($id)
    {
        $edition = MagazineEdition::findOrFail($id);
        $edition->delete();

        return redirect()->route('admin.magazine-editions.index')->with('success', 'Magazine edition deleted.');
    }
}
