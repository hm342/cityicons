@include('pages.in-city', ['city' => $city ?? \App\Models\City::where('slug', 'bhavnagar')->first(), 'articles' => $articles])
