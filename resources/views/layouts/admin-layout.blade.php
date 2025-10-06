@extends('layouts.app')
@section('main')
    <x-navbar class="col-12" :active="$active ?? ''" />

    <div class="container mt-4">
        <div class="row">
            @auth
                @hasanyrole(['admin', 'superadmin'])
                <x-sidebar class="col-lg-3 d-none d-lg-block mb-4" style="top: 1rem;" />
                @endhasanyrole
            @endauth
            <div class="col-12 col-lg-9">
                @yield('content')
            </div>
        </div>
    </div>
@endsection
