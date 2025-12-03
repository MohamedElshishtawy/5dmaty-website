@extends('layouts.app')

@section('css')
<style>
    .auth-wrapper { min-height: 100vh; }
    .auth-card { background: var(--card-bg, #fff); border-radius: 16px; }
    .social-btn { height: 48px; }
    .btn-facebook { background-color: #1877F2; color: #fff; }
    .btn-google { background-color: #fff; color: #000; border: 1px solid rgba(0,0,0,0.12); }
    .separator { display: flex; align-items: center; gap: .75rem; color: #6c757d; }
    .separator::before, .separator::after { content: ""; flex: 1; height: 1px; background: rgba(0,0,0,.15); }
    .password-toggle { cursor: pointer; }
</style>
@endsection

@section('main')
<div class="auth-wrapper bg-secondary-gradient d-flex align-items-center py-5" style="opacity: .95;">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-11 col-sm-10 col-md-6 col-lg-5 col-xl-5">
                <div class="auth-card shadow p-4 p-md-5">
                    @yield('content')
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 d-none d-lg-block">
                <img src="{{ asset('images/5dmaty-globe.png') }}" alt="5dmaty globe" /> 
            </div>
            
        </div>
    </div>
</div>
    <x-footer/>
@endsection






