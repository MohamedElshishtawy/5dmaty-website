@extends('layouts.auth-layout')

@section('content')
<h1 class="h4 fw-bold mb-4" style="color: var(--primary);">{{ __('auth.confirm_password_title') }}</h1>

<p class="text-muted mb-4">{{ __('auth.confirm_password_description') }}</p>

<form method="POST" action="{{ route('password.confirm') }}" novalidate>
    @csrf

    <div class="mb-3">
        <label for="password" class="form-label">{{ __('auth.password_label') }}</label>
        <div class="input-group" style="direction: ltr;">
            <span class="input-group-text bg-white password-toggle" onclick="(function(el){ const input = document.getElementById('password'); const icon = el.querySelector('i'); if(input.type==='password'){ input.type='text'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); } else { input.type='password'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); } })(this)">
                <i class="fa-regular fa-eye"></i>
            </span>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus>

            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('auth.confirm_password_button') }}</button>
</form>

<div class="text-muted small">
    @if (Route::has('password.request'))
        <div>
            {{ __('auth.forgot_your_password') }}
            <a class="text-decoration-underline" href="{{ route('password.request') }}">{{ __('auth.reset_it') }}</a>
        </div>
    @endif
</div>
@endsection