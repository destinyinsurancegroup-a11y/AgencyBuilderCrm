<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agency Builder CRM - Tier 1')</title>
    <link rel="stylesheet" href="{{ secure_asset('css/abc.css') }}">
</head>
<body>
    <div class="layout">
        @include('partials.sidebar')
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
