@extends('layouts.admin-layout')
@php($active = 'dashboard')
@section('content')
<div class="dashboard-page" dir="rtl">
    <section class="welcome-card rounded-4 p-4 p-md-5 mb-4 text-white shadow-lg" style="background: var(--primary-gradient);">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3">
            <div class="flex-fill">
                <p class="mb-1 fs-6 text-uppercase opacity-75">{{ __('general.dashboard_stats_title') }}</p>
                <h1 class="fw-bold mb-2" style="font-size: clamp(1.5rem, 5vw, 2.5rem);">
                    {{ __('general.dashboard_welcome', ['name' => auth()->user()->name]) }}
                </h1>
                <p class="mb-0 fs-5">{{ __('general.dashboard_subtitle') }}</p>
            </div>
            <div class="text-md-end w-100 w-md-auto">
                <span class="badge rounded-pill px-4 py-2 fs-6 border-0" style="background: var(--secondary-gradient); color: #000;">
                    {{ now()->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>
    </section>

    <section class="stat-grid">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @foreach ($statSections ?? [] as $section)
                <div class="col">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="fs-5 fw-bold text-dark mb-0">{{ $section['title'] }}</h2>
                                <span class="rounded-pill px-3 py-1 text-uppercase small" style="background: var(--secondary-gradient); color: #000;">
                                    {{ count($section['items'] ?? []) }} {{ __('general.metrics') ?? '' }}
                                </span>
                            </div>
                            <div class="d-flex flex-column gap-3">
                                @foreach ($section['items'] ?? [] as $item)
                                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2 p-3 rounded-3 bg-white border">
                                        <span class="text-muted">{{ $item['label'] }}</span>
                                        <span class="fs-3 fw-bold text-dark">{{ number_format($item['value']) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection



