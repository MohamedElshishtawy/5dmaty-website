<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1f4dd9add7.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">


{{--    <style>--}}
{{--    :root{--brand-gold:#d4af37;--brand-gold-700:#b38f2c;--brand-black:#111;--brand-white:#fff}--}}
{{--    body{background-color:#fff;color:#111}--}}
{{--    .navbar{background-color:#111!important}--}}
{{-- --}}
{{--    .btn-primary{background-color:var(--brand-gold);border-color:var(--brand-gold)}--}}
{{--    .btn-primary:hover{background-color:var(--brand-gold-700);border-color:var(--brand-gold-700)}--}}
{{--    .sidebar{width:280px;background:#fff;border-inline-start:1px solid #eee}--}}
{{--    .sidebar a{color:#111;text-decoration:none}--}}
{{--    .sidebar .scrollbar{padding:1rem}--}}
{{--    .brand-logo{display:flex;align-items:center;gap:.5rem}--}}
{{--    .brand-logo img{height:28px}--}}
{{--    </style>--}}

    @livewireStyles
</head>
<body dir="rtl">

    <x-navbar class="col-12" />



        <div class="container mt-4">
            <div class="row">
                @auth
                    @role('admin')
                    <x-sidebar class="col-lg-3 d-none d-lg-block mb-4" style="top: 1rem;" />
                    @endrole
                @endauth
                <div class="col-12 col-lg-9">
                    @yield('content')
                </div>
            </div>
        </div>







    @livewire('wire-elements-modal')
</body>
</html>
