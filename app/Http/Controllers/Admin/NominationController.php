<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nomination;
use App\Models\Person;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NominationController extends Controller
{
    public function index(Request $request)
    {
        $query = Nomination::with(['category', 'convertedPerson'])->latest('submitted_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nominee_name', 'like', "%{$s}%")
                  ->orWhere('nominee_city', 'like', "%{$s}%")
                  ->orWhere('nominator_name', 'like', "%{$s}%")
                  ->orWhere('nominator_email', 'like', "%{$s}%");
            });
        }

        $nominations = $query->paginate(15)->withQueryString();

        return view('admin.nominations.index', compact('nominations'));
    }

    public function show($id)
    {
        $nomination = Nomination::with(['category', 'convertedPerson'])->findOrFail($id);

        return view('admin.nominations.show', compact('nomination'));
    }

    public function updateStatus(Request $request, $id)
    {
        $nomination = Nomination::findOrFail($id);

        $validated = $request->validate([
            'status'      => ['required', 'in:pending,reviewed,approved,rejected,converted'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $nomination->update($validated);

        return back()->with('success', 'Nomination status updated to ' . ucfirst($validated['status']));
    }

    public function convertToPerson(Request $request, $id)
    {
        $nomination = Nomination::findOrFail($id);

        if ($nomination->converted_to_person_id) {
            return back()->with('info', 'This nomination has already been converted to a profile.');
        }

        // Try to match city
        $city = City::where('name', 'like', '%' . $nomination->nominee_city . '%')
            ->orWhere('slug', Str::slug($nomination->nominee_city))
            ->first();

        $slug = Str::slug($nomination->nominee_name);
        $origSlug = $slug;
        $count = 1;
        while (Person::where('slug', $slug)->exists()) {
            $slug = $origSlug . '-' . $count++;
        }

        $person = Person::create([
            'name'             => $nomination->nominee_name,
            'slug'             => $slug,
            'type'             => $request->input('type', 'icon'),
            'tagline'          => $nomination->nominee_profession,
            'profession'       => $nomination->nominee_profession,
            'bio'              => '<p>' . e($nomination->nominee_description) . '</p>',
            'city_id'          => $city ? $city->id : null,
            'category_id'      => $nomination->nominee_category_id,
            'portrait_image'   => $nomination->nominee_image_path,
            'cover_image'      => $nomination->nominee_image_path,
            'social_instagram' => $nomination->nominee_social_instagram,
            'social_linkedin'  => $nomination->nominee_social_linkedin,
            'website'          => $nomination->nominee_website,
            'status'           => 'draft',
            'year'             => date('Y'),
            'month'            => date('n'),
        ]);

        $nomination->update([
            'status'                 => 'converted',
            'converted_to_person_id' => $person->id,
            'admin_notes'            => ($nomination->admin_notes ? $nomination->admin_notes . "\n" : '') . 'Converted to profile on ' . now()->toFormattedDateString(),
        ]);

        return redirect()->route('admin.people.edit', $person->id)->with('success', 'Nomination converted to profile draft! You can now refine the bio and publish.');
    }

    public function destroy($id)
    {
        $nomination = Nomination::findOrFail($id);
        $nomination->delete();

        return redirect()->route('admin.nominations.index')->with('success', 'Nomination record deleted.');
    }
}
