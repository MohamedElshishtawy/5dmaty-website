@extends('layouts.auth-layout')

@section('content')
<h1 class="h4 fw-bold mb-4" style="color: var(--primary);">{{ __('auth.verify_title') }}</h1>

@if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('auth.verification_link_sent') }}
    </div>
@endif

<p class="text-muted mb-4">{{ __('auth.verify_instructions') }}</p>

<form method="POST" action="{{ route('verification.resend') }}" novalidate>
    @csrf
    <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('auth.resend_verification_button') }}</button>
</form>

<div class="text-muted small">
    <div>
        {{ __('auth.did_not_receive') }}
    </div>
</div>
@endsection