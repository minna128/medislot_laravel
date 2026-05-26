<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            * { box-sizing: border-box; }
            html, body { height: 100%; }
            body {
                background: #f0fdfa !important;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            .bg-gray-100 { background: #f0fdfa !important; }
            header.bg-white { background: #0f172a !important; border-bottom: 1px solid rgba(255,255,255,0.08) !important; }
            header.bg-white h2 { color: white !important; }
            .bg-white.overflow-hidden.shadow-xl { border: 1px solid #ccfbf1; }
            table thead tr { border-color: #ccfbf1 !important; }
            .page-wrapper { display: flex; flex-direction: column; flex: 1; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="page-wrapper">
            @livewire('navigation-menu')

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main style="flex:1;">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>