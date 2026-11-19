<?php

namespace App\Http\Controllers;

use App\Models\Nomination;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicNominationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nominee_name'       => ['required', 'string', 'max:255'],
            'profession'         => ['required', 'string', 'max:255'],
            'city_connection'    => ['required', 'string', 'max:255'],
            'category'           => ['required', 'string'],
            'about_nominee'      => ['required', 'string'],
            'achievements'       => ['required', 'string'],
            'why_documented'     => ['required', 'string'],
            'nominator_name'     => ['required', 'string', 'max:255'],
            'email'              => ['required', 'email', 'max:255'],
            'phone'              => ['required', 'string', 'max:50'],
            'confirm_accurate'   => ['accepted'],
            'confirm_permission' => ['accepted'],
            'confirm_editorial'  => ['accepted'],
            'confirm_privacy'    => ['accepted'],
        ]);

        $cat = Category::where('name', $request->category)
            ->orWhere('slug', Str::slug($request->category))
            ->first();

        $imagePath = null;
        if ($request->hasFile('documents')) {
            $path = $request->file('documents')->store('nominations', 'public');
            $imagePath = '/storage/' . $path;
        }

        $fullDescription = "About: " . $request->about_nominee . "\n\nAchievements: " . $request->achievements . "\n\nWhy Documented: " . $request->why_documented;
        if ($request->filled('supporting_links')) {
            $fullDescription .= "\n\nSupporting Links: " . $request->supporting_links;
        }

        Nomination::create([
            'nominee_name'             => $request->nominee_name,
            'nominee_city'             => $request->city_connection,
            'nominee_profession'       => $request->profession,
            'nominee_category_id'      => $cat ? $cat->id : null,
            'nominee_description'      => $fullDescription,
            'nominee_website'          => $request->profile_link,
            'nominee_image_path'       => $imagePath,
            'nominator_name'           => $request->nominator_name,
            'nominator_email'          => $request->email,
            'nominator_phone'          => $request->phone,
            'status'                   => 'pending',
            'consent_accuracy'         => true,
            'consent_sharing'          => true,
            'consent_editorial'        => true,
            'consent_no_payment'       => true,
            'consent_terms'            => true,
            'submitted_at'             => now(),
        ]);

        if ($request->boolean('opt_newsletter')) {
            Subscriber::firstOrCreate(
                ['email' => $request->email],
                ['name' => $request->nominator_name, 'source' => 'nominate', 'subscribed_at' => now()]
            );
        }

        return back()->with('success', 'Thank you. Your nomination has been submitted and recorded for editorial review.');
    }

    /**
     * Display city-scoped nomination page (e.g. /bhavnagar/nominate).
     */
    public function cityNominate($citySlug)
    {
        $city = \App\Models\City::where('slug', strtolower($citySlug))->first();
        if (!$city) {
            $city = \App\Models\City::where('slug', 'bhavnagar')->first();
        }

        return view('pages.nominate', ['active' => 'nominate', 'city' => $city]);
    }
}
