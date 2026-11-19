<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class PublicNewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $cityId = null;
        if ($request->filled('city_id')) {
            $cityId = $request->input('city_id');
        } elseif ($request->filled('city_slug')) {
            $city = \App\Models\City::where('slug', $request->city_slug)->first();
            $cityId = $city ? $city->id : null;
        }

        Subscriber::updateOrCreate(
            ['email' => $request->email],
            [
                'city_id' => $cityId,
                'name' => $request->input('name'),
                'source' => $request->input('source', 'footer'),
                'is_active' => true,
                'subscribed_at' => now(),
            ]
        );

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Subscribed to CityIcons newsletter.']);
        }

        return back()->with('success', 'You have been subscribed to CityIcons.');
    }
}
