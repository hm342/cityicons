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

        Subscriber::updateOrCreate(
            ['email' => $request->email],
            [
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
