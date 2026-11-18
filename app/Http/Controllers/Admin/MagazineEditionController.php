<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MagazineEdition;
use Illuminate\Http\Request;

class MagazineEditionController extends Controller
{
    public function index()
    {
        $editions = MagazineEdition::orderBy('issue_number', 'desc')->get();
        return view('admin.magazine-editions.index', compact('editions'));
    }

    public function create()
    {
        return view('admin.magazine-editions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'issue_number'     => ['required', 'integer', 'unique:magazine_editions,issue_number'],
            'title'            => ['required', 'string', 'max:255'],
            'cover_image_file' => ['nullable', 'image', 'max:5120'],
            'cover_image_url'  => ['nullable', 'url'],
            'description'      => ['nullable', 'string'],
            'published_date'   => ['nullable', 'date'],
            'is_active'        => ['boolean'],
        ]);

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
        $edition = MagazineEdition::findOrFail($id);
        return view('admin.magazine-editions.edit', compact('edition'));
    }

    public function update(Request $request, $id)
    {
        $edition = MagazineEdition::findOrFail($id);

        $validated = $request->validate([
            'issue_number'     => ['required', 'integer', 'unique:magazine_editions,issue_number,' . $edition->id],
            'title'            => ['required', 'string', 'max:255'],
            'cover_image_file' => ['nullable', 'image', 'max:5120'],
            'cover_image_url'  => ['nullable', 'url'],
            'description'      => ['nullable', 'string'],
            'published_date'   => ['nullable', 'date'],
            'is_active'        => ['boolean'],
        ]);

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
