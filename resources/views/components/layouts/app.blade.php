<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $description ?? "CITYICON — India's Premier City Magazine. Curating the best stories in Fashion, Living Culture, Food, and Heritage across India's cities." }}">
  <title>{{ $title ?? "CITYICONS — India's City Magazine" }}</title>
  
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏙</text></svg>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  @stack('styles')
</head>
<body>

  <!-- Offcanvas Slideout Drawer -->
  <x-drawer />

  <!-- Site Master Header -->
  <x-header />

  <!-- Sticky City Navigation Bar -->
  <x-city-navbar :active="$activeCity ?? 'all'" />

  <!-- Main Content Slot -->
  <main id="main-content">
    {{ $slot }}
  </main>

  <!-- Site Footer -->
  <x-footer />

  <!-- Search Modal Overlay -->
  <x-search-modal />

  <!-- Scripts -->
  <script src="{{ asset('js/data.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
