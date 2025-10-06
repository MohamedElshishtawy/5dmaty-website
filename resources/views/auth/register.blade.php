@extends('layouts.auth-layout')

@section('content')
<h1 class="h4 fw-bold mb-4" style="color: var(--primary);">{{ __('auth.register_title') }}</h1>

<form method="POST" action="{{ route('register') }}" novalidate>
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('auth.name_label') }}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('auth.email_label') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('auth.phone_label') }}</label>
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">{{ __('auth.address_label') }}</label>
        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="street-address">
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">{{ __('auth.password_label') }}</label>
        <div class="input-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <span class="input-group-text bg-white password-toggle" onclick="(function(el){ const input = document.getElementById('password'); const icon = el.querySelector('i'); if(input.type==='password'){ input.type='text'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); } else { input.type='password'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); } })(this)">
                <i class="fa-regular fa-eye"></i>
            </span>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="password-confirm" class="form-label">{{ __('auth.password_confirm_label') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('auth.register_button') }}</button>
</form>

<div class="text-muted small">
    {{ __('auth.already_have_account') }}
    <a class="text-decoration-underline" href="{{ route('login') }}">{{ __('auth.login_now') }}</a>
</div>
@endsection
