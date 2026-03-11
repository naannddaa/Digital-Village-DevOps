<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Default title')</title>

  {{-- General CSS Files --}}
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

  {{-- CSS Libraries (per halaman) --}}
  @stack('css-lib')



  {{-- Template CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  {{-- Slot tambahan di <head> jika perlu --}}
  @stack('head')

  {{-- Google Analytics: aktif hanya di production --}}
  @env('production')
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.ga.id', 'UA-94034622-3') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ config('services.ga.id', 'UA-94034622-3') }}');
    </script>
  @endenv
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      
      {{-- Navbar --}}
      @include('admin.layout.navbar')

      {{-- Sidebar --}}
      @include('admin.layout.sidebar')

      {{-- Main Content --}}
      <div class="main-content">
        @yield('content')
      </div>

      {{-- Footer (opsional) --}}
      {{-- @includeWhen(View::exists('layouts.footer'), 'layouts.footer') --}}

    </div>
  </div>

  {{-- General JS Scripts --}}
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <script src="{{ asset('assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

  {{-- JS Libraries (per halaman) --}}
  @stack('js-lib')

  {{-- Page Specific JS --}}
  @stack('page-js')

  {{-- Template JS --}}
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
@keyframes slideInRight {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}
</style>
  @stack('scripts')
</body>
</html>
