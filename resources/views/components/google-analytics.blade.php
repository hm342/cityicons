@php
  $gaId = \Illuminate\Support\Facades\Cache::remember('site_ga_id', 3600, function() {
      return \App\Models\Setting::get('google_analytics_id') 
          ?: config('services.google.analytics_id') 
          ?: env('GOOGLE_ANALYTICS_ID');
  });
@endphp

@if(!empty($gaId))
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ $gaId }}');
  </script>
@endif
