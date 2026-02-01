<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Support\Settings::get('seo.home.title', config('app.name', 'Laravel')) }}</title>
    @php
        $metaDescription = \App\Models\Setting::where('key', 'seo.home.description')->where('locale', app()->getLocale())->value('value');
        $metaKeywords = \App\Models\Setting::where('key', 'seo.home.keywords')->where('locale', app()->getLocale())->value('value');
        $faviconUrl = \App\Models\Setting::where('key', 'site.favicon')->value('value');
    @endphp
    @if(!empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    @if($metaKeywords)
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
        <link rel="icon" href="{{ $faviconUrl ? asset('storage/' . $faviconUrl) : '' }}" type="image/x-icon">

    {{--Modal reqiremnts Alphine & tailwind--}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1f4dd9add7.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- Parastoo font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Parastoo:wght@400..700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{asset('css/app.css' )}}?v=5">

    @if(App\Models\Language::where('code', app()->getLocale())->where('is_rtl', false)->exists())
        <link rel="stylesheet" href="{{ asset('css/ltr.css') }}">
    @endif
    
    @yield('css')
    @livewireStyles
    
</head>
<body dir="{{ App\Models\Language::where('code', app()->getLocale())->value('is_rtl') ? 'rtl' : 'ltr' }}">

    @yield('main')


    @livewireScripts
    @livewire('wire-elements-modal')
    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @yield('js')
</body>
</html>
