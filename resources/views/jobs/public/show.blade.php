@extends('layouts.normal-layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/jobs.css')}}">
@endsection

@section('content')
    <x-navbar active="employment" class="shadow-sm sticky-top" />

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Job Details -->
                <div class="col-lg-8">
                    <div class="job-detail-card bg-white p-4">
                        <!-- Status Badges (if owner or admin) -->
                        @auth
                            @if(Auth::id() === $job->user_id || Auth::user()->hasRole(['superadmin', 'admin']))
                                <div class="mb-3">
                                    @if($job->status === 'pending')
                                        <span class="badge bg-warning">{{ __('general.pending_review') }}</span>
                                    @elseif($job->status === 'approved')
                                        <span class="badge bg-success">{{ __('general.approved') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('general.rejected') }}</span>
                                    @endif

                                    @if(!$job->is_active)
                                        <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                                    @endif
                                </div>
                            @endif
                        @endauth

                        <h1 class="h3 fw-bold mb-3">{{ $job->title }}</h1>

                        @if($job->shop_name || $job->shop_address)
                            <div class="mb-4">
                                @if($job->shop_name)
                                    <p class="mb-2">
                                        <i class="fas fa-store text-primary me-2"></i>
                                        <strong>{{ __('general.shop_name') }}:</strong> {{ $job->shop_name }}
                                    </p>
                                @endif
                                @if($job->shop_address)
                                    <p class="mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <strong>{{ __('general.location') }}:</strong> {{ $job->shop_address }}
                                    </p>
                                @endif
                            </div>
                        @endif

                        @if($job->description)
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">{{ __('general.job_description') }}</h5>
                                <p class="text-muted" style="white-space: pre-line;">{{ $job->description }}</p>
                            </div>
                        @endif

                        <div class="text-muted small">
                            <i class="fas fa-calendar me-1"></i>
                            {{ __('general.published_at') }}: {{ $job->published_at->format('Y-m-d') }}
                        </div>
                    </div>
                </div>

                <!-- Action Sidebar -->
                <div class="col-lg-4">
                    <div class="job-detail-card bg-white p-4 sticky-top" style="top: 80px;">
                        <h5 class="fw-bold mb-3">{{ __('general.actions') }}</h5>

                        @if($job->whatsapp_phone)
                            @php
                                $wa_number = preg_replace('/\D+/', '', $job->whatsapp_phone);
                                $wa_text = urlencode(__('general.job_whatsapp_message', ['title' => $job->title]));
                                $wa_url = "https://wa.me/{$wa_number}?text={$wa_text}";
                            @endphp
                            <a href="{{ $wa_url }}" 
                               target="_blank" 
                               class="btn whatsapp-btn w-100 mb-3">
                                <i class="fab fa-whatsapp me-2"></i>
                                {{ __('general.contact_whatsapp') }}
                            </a>
                        @endif

                        @auth
                            @if($job->status === 'approved' && $job->is_active)
                                <button class="btn btn-primary w-100 mb-3" 
                                        onclick="Livewire.dispatch('openModal', {component: 'apply-to-job-modal', arguments: {job: {{ $job->id }}}})">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    {{ __('general.apply_now') }}
                                </button>
                            @endif

                            <!-- Owner/Admin Actions -->
                            @if(Auth::id() === $job->user_id || Auth::user()->hasRole(['superadmin', 'admin']))
                                <div class="border-top pt-3 mt-3">
                                    <h6 class="fw-bold mb-3">{{ __('general.manage') }}</h6>
                                    
                                    <button class="btn btn-info w-100 mb-2" 
                                            onclick="Livewire.dispatch('openModal', {component: 'create-edit-job-modal', arguments: {job: {{ $job->id }}}})">
                                        <i class="fas fa-edit me-2"></i>
                                        {{ __('general.edit_job') }}
                                    </button>

                                    @if($job->status === 'approved')
                                        <form action="{{ route('jobs.toggleActive', $job) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-{{$job->is_active ? 'warning' : 'success'}} w-100 mb-2">
                                                <i class="fas fa-{{$job->is_active ? 'pause' : 'play'}} me-2"></i>
                                                {{ $job->is_active ? __('general.close_job') : __('general.open_job') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}?intended={{ route('jobs.show', $job->slug) }}" 
                               class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                {{ __('general.login_to_apply') }}
                            </a>
                        @endauth

                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-right me-2"></i>
                            {{ __('general.back_to_jobs') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer/>
@endsection

