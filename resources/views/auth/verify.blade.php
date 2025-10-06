@extends('layouts.auth-layout')

@section('content')
<h1 class="h5 fw-bold mb-3" style="color: var(--primary);">{{ __('auth.verify_title') }}</h1>

@if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('auth.verification_link_sent') }}
    </div>
@endif

<p class="mb-3">{{ __('auth.verify_instructions') }}</p>
<p class="mb-0">
    {{ __('auth.did_not_receive') }}
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth.request_another') }}</button>
    </form>
</p>
@endsection
