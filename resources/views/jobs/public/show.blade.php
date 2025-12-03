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

                    </div>

                    <!-- Applications Section (Owner/Admin Only) -->
                    @auth
                        @if((Auth::id() === $job->user_id || Auth::user()->hasRole(['superadmin', 'admin'])) && $applications->count() > 0)
                            <div class="job-detail-card bg-white p-4 mt-4">
                                <h5 class="fw-bold mb-3">{{ __('general.applications') }} ({{ $applications->count() }})</h5>
                                
                                @foreach($applications as $application)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h6 class="fw-bold mb-1">{{ $application->name }}</h6>
                                                    @if($application->age)
                                                        <small class="text-muted">{{ __('general.age') }}: {{ $application->age }}</small>
                                                    @endif
                                                </div>
                                                <span class="badge bg-{{ $application->status === 'accepted' ? 'success' : ($application->status === 'rejected' ? 'danger' : 'warning') }}">
                                                    @if($application->status === 'accepted')
                                                        {{ __('general.accepted') }}
                                                    @elseif($application->status === 'rejected')
                                                        {{ __('general.rejected') }}
                                                    @else
                                                        {{ __('general.pending') }}
                                                    @endif
                                                </span>
                                            </div>

                                            <div class="row g-2 mb-2">
                                                @if($application->education)
                                                    <div class="col-6">
                                                        <small><strong>{{ __('general.education') }}:</strong> {{ $application->education }}</small>
                                                    </div>
                                                @endif
                                                @if($application->marital_status)
                                                    <div class="col-6">
                                                        <small><strong>{{ __('general.marital_status') }}:</strong> {{ $application->marital_status }}</small>
                                                    </div>
                                                @endif
                                                @if($application->military_status)
                                                    <div class="col-6">
                                                        <small><strong>{{ __('general.military_status') }}:</strong> {{ $application->military_status }}</small>
                                                    </div>
                                                @endif
                                                @if($application->residence)
                                                    <div class="col-6">
                                                        <small><strong>{{ __('general.residence') }}:</strong> {{ $application->residence }}</small>
                                                    </div>
                                                @endif
                                                @if($application->desired_position)
                                                    <div class="col-12">
                                                        <small><strong>{{ __('general.desired_position') }}:</strong> {{ $application->desired_position }}</small>
                                                    </div>
                                                @endif
                                                @if($application->whatsapp_phone)
                                                    <div class="col-12">
                                                        <small><strong>{{ __('general.whatsapp_phone') }}:</strong> 
                                                            <a href="https://wa.me/{{ preg_replace('/\D+/', '', $application->whatsapp_phone) }}" target="_blank">
                                                                {{ $application->whatsapp_phone }}
                                                            </a>
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($application->about)
                                                <div class="mb-2">
                                                    <small><strong>{{ __('general.about_employee') }}:</strong></small>
                                                    <p class="mb-0 small text-muted" style="white-space: pre-line;">{{ $application->about }}</p>
                                                </div>
                                            @endif

                                            <div class="d-flex gap-2 mt-3">
                                                @if($application->status !== 'accepted')
                                                    <form action="{{ route('jobs.applications.updateStatus', ['job' => $job->slug, 'application' => $application->id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="accepted">
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-check me-1"></i>
                                                            {{ __('general.accept') }}
                                                        </button>
                                                    </form>
                                                @endif
                                                @if($application->status !== 'rejected')
                                                    <form action="{{ route('jobs.applications.updateStatus', ['job' => $job->slug, 'application' => $application->id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-times me-1"></i>
                                                            {{ __('general.reject') }}
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>

                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ __('general.applied_at') }}: {{ $application->created_at->format('Y-m-d H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endauth
                </div>

                <!-- Action Sidebar -->
                <div class="col-lg-4">
                    <div class="job-detail-card bg-white p-4 sticky-top z-0" style="top: 80px;">
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

                        @if($job->status === 'approved' && $job->is_active)
                            <button class="btn btn-primary w-100 mb-3" 
                                    onclick="Livewire.dispatch('openModal', {component: 'apply-to-job-modal', arguments: {job: {{ $job->id }}}})">
                                <i class="fas fa-paper-plane me-2"></i>
                                {{ __('general.apply_now') }}
                            </button>
                        @endif

                        @auth
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

