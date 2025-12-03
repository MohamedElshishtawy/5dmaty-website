@extends('layouts.auth-layout')

@section('content')
<h1 class="h4 fw-bold mb-4" style="color: var(--primary);">{{ __('auth.forgot_password_title') }}</h1>

<p class="text-muted mb-4">{{ __('auth.forgot_password_description') }}</p>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}" novalidate>
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('auth.email_label') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('auth.send_reset_link_button') }}</button>
</form>

<div class="text-muted small">
    <div>
        {{ __('auth.remember_password') }}
        <a class="text-decoration-underline" href="{{ route('login') }}">{{ __('auth.back_to_login') }}</a>
    </div>
</div>
@endsection