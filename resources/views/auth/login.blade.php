@extends('layouts.auth-layout')

@section('content')
<h1 class="h4 fw-bold mb-4" style="color: var(--primary);">{{ __('auth.login_title') }}</h1>

<div class="d-grid gap-2 mb-3">
    <a href="{{route('google.redirect')}}" class="btn btn-google social-btn d-flex align-items-center justify-content-center gap-2">
        <i class="fa-brands fa-google"></i>
        <span>{{ __('auth.continue_with_google') }}</span>
    </a>
{{--    <a href="#" class="btn btn-facebook social-btn d-flex align-items-center justify-content-center gap-2">--}}
{{--        <i class="fa-brands fa-facebook-f"></i>--}}
{{--        <span>{{ __('auth.continue_with_facebook') }}</span>--}}
{{--    </a>--}}
    </div>

<div class="separator mb-3"><span>{{ __('auth.or') }}</span></div>

<form method="POST" action="{{ route('login') }}" novalidate>
    @csrf

    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('auth.phone_label') }}</label>
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel" autofocus>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="password" class="form-label">{{ __('auth.password_label') }}</label>
        <div class="input-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <span class="input-group-text bg-white password-toggle" onclick="(function(el){ const input = document.getElementById('password'); const icon = el.querySelector('i'); if(input.type==='password'){ input.type='text'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); } else { input.type='password'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); } })(this)">
                <i class="fa-regular fa-eye"></i>
            </span>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">{{ __('auth.remember_me') }}</label>
        </div>
        @if (Route::has('password.request'))
            <a class="small text-decoration-none" href="{{ route('password.request') }}">{{ __('auth.forgot_password') }}</a>
        @endif
    </div>

    <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('auth.login_button') }}</button>
</form>

<div class="text-muted small">
    <div class="mb-1">{{ __('auth.trouble_access') }}</div>
    <div>
        {{ __('auth.no_account') }}
        <a class="text-decoration-underline" href="{{ route('register') }}">{{ __('auth.signup_emphasis') }}</a>
    </div>
</div>
@endsection
