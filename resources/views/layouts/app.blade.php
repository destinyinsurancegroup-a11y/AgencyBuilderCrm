<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Agency Builder CRM')</title>

  {{-- Load your black-and-gold CSS file --}}
  <link rel="stylesheet" href="{{ asset('css/abc.css') }}">
</head>

<body>
  <div class="layout">
    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Main Content Area --}}
    <main class="right">
      @yield('content')
    </main>
  </div>
</body>
</html>
