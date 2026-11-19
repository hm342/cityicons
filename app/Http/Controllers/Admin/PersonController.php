<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Category;
use App\Models\City;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $query = Person::with(['city', 'category', 'tags'])->latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('profession', 'like', "%{$s}%")
                  ->orWhere('organization', 'like', "%{$s}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $activeCityId = session('admin_city_id');
        if ($activeCityId) {
            $query->where('city_id', $activeCityId);
        } elseif ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $people = $query->paginate(15)->withQueryString();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.people.index', compact('people', 'cities', 'activeCityId'));
    }

    public function create()
    {
        $selectedCityId = session('admin_city_id');
        $categories = Category::forCity($selectedCityId)->orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::forCity($selectedCityId)->orderBy('name')->get();

        return view('admin.people.create', compact('categories', 'cities', 'tags', 'selectedCityId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'slug'                => ['nullable', 'string', 'max:255', 'unique:people,slug'],
            'type'                => ['required', 'in:icon,rising,voice'],
            'tagline'             => ['nullable', 'string', 'max:255'],
            'bio'                 => ['nullable', 'string'],
            'profession'          => ['nullable', 'string', 'max:255'],
            'organization'        => ['nullable', 'string', 'max:255'],
            'city_id'             => ['nullable', 'exists:cities,id'],
            'category_id'         => ['nullable', 'exists:categories,id'],
            'year'                => ['nullable', 'integer', 'min:2020', 'max:2050'],
            'month'               => ['nullable', 'integer', 'min:1', 'max:12'],
            'social_instagram'    => ['nullable', 'string', 'max:255'],
            'social_linkedin'     => ['nullable', 'string', 'max:255'],
            'website'             => ['nullable', 'string', 'max:255'],
            'portrait_image_file' => ['nullable', 'image', 'max:5120'],
            'portrait_image_url'  => ['nullable', 'url'],
            'is_featured'         => ['boolean'],
            'status'              => ['required', 'in:draft,published'],
            'sort_order'          => ['nullable', 'integer'],
            'tags'                => ['nullable', 'array'],
            'tags.*'              => ['exists:tags,id'],
        ]);

        if (session('admin_city_id')) {
            $validated['city_id'] = session('admin_city_id');
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $origSlug = $validated['slug'];
        $count = 1;
        while (Person::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $origSlug . '-' . $count++;
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('portrait_image_file')) {
            $path = $request->file('portrait_image_file')->store('people', 'public');
            $validated['portrait_image'] = '/storage/' . $path;
            $validated['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('portrait_image_url')) {
            $validated['portrait_image'] = $request->portrait_image_url;
            $validated['cover_image'] = $request->portrait_image_url;
        }

        unset($validated['portrait_image_file'], $validated['portrait_image_url'], $validated['tags']);

        $person = Person::create($validated);

        if ($request->filled('tags')) {
            $person->tags()->sync($request->tags);
        }

        return redirect()->route('admin.people.index')->with('success', 'Profile created successfully.');
    }

    public function edit($id)
    {
        $person = Person::with('tags')->findOrFail($id);
        $selectedCityId = session('admin_city_id') ?: $person->city_id;
        $categories = Category::forCity($selectedCityId)->orderBy('name')->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::forCity($selectedCityId)->orderBy('name')->get();

        return view('admin.people.edit', compact('person', 'categories', 'cities', 'tags', 'selectedCityId'));
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);

        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'slug'                => ['nullable', 'string', 'max:255', 'unique:people,slug,' . $person->id],
            'type'                => ['required', 'in:icon,rising,voice'],
            'tagline'             => ['nullable', 'string', 'max:255'],
            'bio'                 => ['nullable', 'string'],
            'profession'          => ['nullable', 'string', 'max:255'],
            'organization'        => ['nullable', 'string', 'max:255'],
            'city_id'             => ['nullable', 'exists:cities,id'],
            'category_id'         => ['nullable', 'exists:categories,id'],
            'year'                => ['nullable', 'integer', 'min:2020', 'max:2050'],
            'month'               => ['nullable', 'integer', 'min:1', 'max:12'],
            'social_instagram'    => ['nullable', 'string', 'max:255'],
            'social_linkedin'     => ['nullable', 'string', 'max:255'],
            'website'             => ['nullable', 'string', 'max:255'],
            'portrait_image_file' => ['nullable', 'image', 'max:5120'],
            'portrait_image_url'  => ['nullable', 'url'],
            'is_featured'         => ['boolean'],
            'status'              => ['required', 'in:draft,published'],
            'sort_order'          => ['nullable', 'integer'],
            'tags'                => ['nullable', 'array'],
            'tags.*'              => ['exists:tags,id'],
        ]);

        if (session('admin_city_id')) {
            $validated['city_id'] = session('admin_city_id');
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('portrait_image_file')) {
            $path = $request->file('portrait_image_file')->store('people', 'public');
            $validated['portrait_image'] = '/storage/' . $path;
            $validated['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('portrait_image_url')) {
            $validated['portrait_image'] = $request->portrait_image_url;
            $validated['cover_image'] = $request->portrait_image_url;
        }

        unset($validated['portrait_image_file'], $validated['portrait_image_url'], $validated['tags']);

        $person->update($validated);

        if ($request->has('tags')) {
            $person->tags()->sync($request->tags ?? []);
        }

        return redirect()->route('admin.people.index')->with('success', 'Profile updated successfully.');
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->tags()->detach();
        $person->delete();

        return redirect()->route('admin.people.index')->with('success', 'Profile deleted.');
    }
}
