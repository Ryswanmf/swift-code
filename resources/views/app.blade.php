<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        @php
            $customFavicon = \App\Models\Setting::get('site_favicon');
            $customOgImage = \App\Models\Setting::get('site_logo', asset('images/logo.png'));
        @endphp
        <!-- Favicon & Brand Icons -->
        @if($customFavicon)
            <link rel="icon" href="{{ $customFavicon }}">
            <link rel="apple-touch-icon" href="{{ $customFavicon }}">
        @else
            <link rel="icon" type="image/x-icon" href="/favicon.ico">
            <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
            <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        @endif
        <link rel="manifest" href="/site.webmanifest">
        <meta name="theme-color" content="#e11d2e">
        <meta property="og:image" content="{{ $customOgImage }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
