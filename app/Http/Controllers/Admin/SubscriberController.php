<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscriber::latest('subscribed_at');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('email', 'like', "%{$s}%")
                  ->orWhere('name', 'like', "%{$s}%");
            });
        }

        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        $subscribers = $query->paginate(25)->withQueryString();

        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function export(): StreamedResponse
    {
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="cityicons_subscribers_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Email', 'Name', 'Source', 'Is Active', 'Subscribed At']);

            Subscriber::chunk(200, function ($subscribers) use ($file) {
                foreach ($subscribers as $s) {
                    fputcsv($file, [
                        $s->id,
                        $s->email,
                        $s->name,
                        $s->source,
                        $s->is_active ? 'Yes' : 'No',
                        $s->subscribed_at ? $s->subscribed_at->format('Y-m-d H:i') : '',
                    ]);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy($id)
    {
        $sub = Subscriber::findOrFail($id);
        $sub->delete();

        return back()->with('success', 'Subscriber removed.');
    }
}
