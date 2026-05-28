<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
        <link rel="shortcut icon" href="{{ asset('logo.svg') }}">        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MediSlot') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
            body { margin: 0; padding: 0; }
        </style>
    </head>
    <body>
        {{ $slot }}
    </body>
</html>