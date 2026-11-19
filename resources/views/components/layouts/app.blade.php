@props([
  'title' => null,
  'description' => null,
  'activeCity' => 'all',
  'city' => null,
  'transparentHeader' => false,
  'darkTheme' => false
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $description ?? "CITYICON — India's Premier City Magazine. Curating the best stories in Fashion, Living Culture, Food, and Heritage across India's cities." }}">
  <title>{{ $title ?? "CITYICONS — India's City Magazine" }}</title>
  
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/logo-cityicons-square.png') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <style>
    /* Global Smooth AJAX Filter & Navigation Progress Bar */
    #site-progress-bar {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      width: 0%;
      background: linear-gradient(90deg, #e51a24, #b51622);
      z-index: 99999;
      opacity: 0;
      transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease;
      pointer-events: none;
      box-shadow: 0 0 10px rgba(229, 26, 36, 0.6);
    }
    #main-content {
      opacity: 1;
      transition: opacity 0.18s ease-in-out;
    }
    #main-content.is-filtering {
      opacity: 0.45;
      pointer-events: none;
    }
  </style>
  @stack('styles')
</head>
<body class="{{ $darkTheme ? 'rm-dark-theme' : '' }}">
  <!-- Global Top Progress Bar -->
  <div id="site-progress-bar"></div>

  <!-- Offcanvas Slideout Drawer -->
  <x-drawer :city="$city" />

  @if(!$transparentHeader)
    <!-- Site Master Header -->
    <x-header :city="$city" />

    <!-- Sticky City Navigation Bar -->
    <x-city-navbar :active="$activeCity ?? 'all'" :city="$city" />
  @endif

  <!-- Main Content Slot -->
  <main id="main-content">
    {{ $slot }}
  </main>

  <!-- Site Footer -->
  <x-footer :city="$city" />

  <!-- Search Modal Overlay -->
  <x-search-modal />

  <!-- Floating Back-to-Top Button (Real Moments) -->
  <button class="rm-back-to-top" id="rm-back-to-top" aria-label="Back to Top">
    <i class="fas fa-arrow-up"></i>
  </button>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
