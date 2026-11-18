<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('sort_order')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'logo_image_file' => ['nullable', 'image', 'max:2048'],
            'logo_image_url'  => ['nullable', 'url'],
            'website_url'     => ['nullable', 'url'],
            'description'     => ['nullable', 'string'],
            'disclosure_text' => ['nullable', 'string'],
            'is_active'       => ['boolean'],
            'is_featured'     => ['boolean'],
            'sort_order'      => ['nullable', 'integer'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('logo_image_file')) {
            $path = $request->file('logo_image_file')->store('brands', 'public');
            $validated['logo_image'] = '/storage/' . $path;
        } elseif ($request->filled('logo_image_url')) {
            $validated['logo_image'] = $request->logo_image_url;
        }

        unset($validated['logo_image_file'], $validated['logo_image_url']);

        Brand::create($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Brand partner added.');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'logo_image_file' => ['nullable', 'image', 'max:2048'],
            'logo_image_url'  => ['nullable', 'url'],
            'website_url'     => ['nullable', 'url'],
            'description'     => ['nullable', 'string'],
            'disclosure_text' => ['nullable', 'string'],
            'is_active'       => ['boolean'],
            'is_featured'     => ['boolean'],
            'sort_order'      => ['nullable', 'integer'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('logo_image_file')) {
            $path = $request->file('logo_image_file')->store('brands', 'public');
            $validated['logo_image'] = '/storage/' . $path;
        } elseif ($request->filled('logo_image_url')) {
            $validated['logo_image'] = $request->logo_image_url;
        }

        unset($validated['logo_image_file'], $validated['logo_image_url']);

        $brand->update($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Brand partner updated.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand partner removed.');
    }
}
