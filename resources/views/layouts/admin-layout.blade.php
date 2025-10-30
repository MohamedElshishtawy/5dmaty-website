@extends('layouts.app')
@section('main')
    <x-navbar class="col-12 position-sticky top-0 z-3" :active="$active ?? ''" />

    <div class="d-flex" style="background: #f2f3f6;">
        @auth
                @hasanyrole(['admin', 'superadmin'])
                <x-sidebar class="d-none d-lg-block mb-4" style="height: calc(100vh - 56.8px); width: 250px;" />
                @endhasanyrole
            @endauth
            <div class="main-content">
                <div class="container mt-4 content-container"> 
                    @yield('content')
                </div>
            </div>
    </div>
    
@endsection
