<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <!-- TODO Obtain meta tags by current page -->
        <link rel="icon" href="{{ asset('assets/ico/cenitvital.ico') }}" sizes="any">
        <!-- <link rel="icon" href="/favicon.svg" type="image/svg+xml"> -->
        <!-- <link rel="apple-touch-icon" href="/apple-touch-icon.png"> -->
        <link rel="manifest" href="{{ asset('/assets/manifest/site.webmanifest') }}">
        <script src="{{ asset('js/serviceworker.js') }}" defer></script>
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'role' => Auth::user()->role,
            'api_token' => (Auth::user()) ? Auth::user()->api_token : null,
            'app_name' => env('APP_NAME')
        ]) !!};
        </script>
        @routes
        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
