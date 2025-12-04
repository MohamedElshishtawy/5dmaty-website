@extends('layouts.normal-layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/jobs.css')}}?v=1">
@endsection

@section('content')
    <x-navbar active="employment" class="shadow-sm sticky-top" />

    <section class="hero-jobs">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-dark mb-3">
                    @if($tab === 'jobs')
                        {{ __('general.jobs') }}
                    @else
                        {{ __('general.employees') }}
                    @endif
                </h1>
                <p class="lead text-muted">
                    @if($tab === 'jobs')
                        {{ __('general.jobs_subtitle') }}
                    @else
                        {{ __('general.employees_subtitle') }}
                    @endif
                </p>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #fff;">
        <div class="container">
            <!-- Centered Tabs -->
            <div class="job-tabs">
                <a href="{{ route('jobs.index', ['tab' => 'jobs']) }}" 
                   class="job-tab {{ $tab === 'jobs' ? 'active' : '' }}">
                    <i class="fas fa-briefcase me-2"></i>
                    {{ __('general.add_job') }}
                </a>
                <a href="{{ route('jobs.index', ['tab' => 'employees']) }}" 
                   class="job-tab {{ $tab === 'employees' ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>
                    {{ __('general.employment_request') }}
                </a>
            </div>

            <!-- Jobs Tab Content -->
            @if($tab === 'jobs')
                <!-- CTA Card for Shop Owners -->
                <div class="cta-card text-center">
                    <h3 class="fw-bold text-dark mb-3">
                        <i class="fas fa-store me-2"></i>
                        {{ __('general.post_job_cta') }}
                    </h3>
                    <p class="text-dark mb-3">{{ __('general.post_job_cta_sub') }}</p>
                    @auth
                        <button class="btn btn-dark btn-lg" 
                                wire:click="$dispatch('openModal', {'component': 'create-edit-job-modal'})"
                                onclick="Livewire.dispatch('openModal', {component: 'create-edit-job-modal'})">
                            <i class="fas fa-plus me-2"></i>
                            {{ __('general.add_job') }}
                        </button>
                    @else
                        <a href="{{ route('login') }}?intended={{ route('jobs.index', ['tab' => 'jobs', 'action' => 'create']) }}" 
                           class="btn btn-dark btn-lg">
                            <i class="fas fa-plus me-2"></i>
                            {{ __('general.add_job') }}
                        </a>
                    @endauth
                </div>

                <!-- Jobs Grid -->
                @if($jobs->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($jobs as $job)
                            <div class="col">
                                <div class="card job-card h-100 border-0 shadow-sm">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold">{{ $job->title }}</h5>
                                        
                                        @if($job->shop_name)
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-store me-1"></i>
                                                {{ $job->shop_name }}
                                            </p>
                                        @endif

                                        @if($job->shop_address)
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $job->shop_address }}
                                            </p>
                                        @endif

                                        @if($job->description)
                                            <p class="card-text text-muted mb-3">
                                                {{ Str::limit($job->description, 100) }}
                                            </p>
                                        @endif

                                        <div class="mt-auto">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('jobs.show', $job->slug) }}" 
                                                   class="btn btn-primary flex-grow-1">
                                                    {{ __('general.view_details') }}
                                                </a>
                                                @if($job->whatsapp_phone)
                                                    @php
                                                        $wa_number = preg_replace('/\D+/', '', $job->whatsapp_phone);
                                                        $wa_text = urlencode(__('general.job_whatsapp_message', ['title' => $job->title]));
                                                        $wa_url = "https://wa.me/{$wa_number}?text={$wa_text}";
                                                    @endphp
                                                    <a href="{{ $wa_url }}" 
                                                       target="_blank" 
                                                       class="btn btn-success">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $jobs->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-briefcase fa-4x text-muted mb-3"></i>
                        <h3 class="text-muted">{{ __('general.no_jobs') }}</h3>
                    </div>
                @endif

            @else
                <!-- Employees Tab Content -->
                <div class="cta-card text-center">
                    <h3 class="fw-bold text-dark mb-3">
                        <i class="fas fa-user-tie me-2"></i>
                        @auth
                            @if(auth()->user()->employeeProfile)
                                {{ __('general.edit_your_profile') }}
                            @else
                                {{ __('general.add_your_profile') }}
                            @endif
                        @else
                            {{ __('general.add_or_edit_profile') }}
                        @endauth
                    </h3>
                    <p class="text-dark mb-3">{{ __('general.profile_cta_sub') }}</p>
                    @auth
                        <button class="btn btn-dark btn-lg" 
                                onclick="Livewire.dispatch('openModal', {component: 'upsert-employee-profile-modal'})">
                            <i class="fas fa-user-edit me-2"></i>
                            {{ __('general.add_your_data') }}
                        </button>
                    @else
                        <a href="{{ route('login') }}?intended={{ route('jobs.index', ['tab' => 'employees', 'action' => 'edit_profile']) }}" 
                           class="btn btn-dark btn-lg">
                            <i class="fas fa-user-edit me-2"></i>
                            {{ __('general.add_your_data') }}
                        </a>
                    @endauth
                </div>

                <!-- Employees Grid -->
                @if($employees->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($employees as $employee)
                            <div class="col">
                                <div class="card employee-card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $employee->name }}</h5>
                                        
                                        @if($employee->desired_position)
                                            <p class="text-primary mb-2">
                                                <i class="fas fa-briefcase me-1"></i>
                                                {{ $employee->desired_position }}
                                            </p>
                                        @endif

                                        @if($employee->residence)
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $employee->residence }}
                                            </p>
                                        @endif

                                        @if($employee->education)
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-graduation-cap me-1"></i>
                                                {{ $employee->education }}
                                            </p>
                                        @endif

                                        @if($employee->age)
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $employee->age }} {{ __('general.years') }}
                                            </p>
                                        @endif

                                        @if($employee->about)
                                            <p class="card-text text-muted mt-3">
                                                {{ $employee->about }}
                                            </p>
                                        @endif

                                        @if($employee->whatsapp_phone)
                                            @php
                                                $wa_number = preg_replace('/\D+/', '', $employee->whatsapp_phone);
                                                $wa_text = urlencode(__('general.employee_whatsapp_message', ['name' => $employee->name]));
                                                $wa_url = "https://wa.me/{$wa_number}?text={$wa_text}";
                                            @endphp
                                            <div class="mt-3">
                                                <a href="{{ $wa_url }}" 
                                                   target="_blank" 
                                                   class="btn btn-success w-100">
                                                    <i class="fab fa-whatsapp me-2"></i>
                                                    {{ __('general.contact_whatsapp') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $employees->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-4x text-muted mb-3"></i>
                        <h3 class="text-muted">{{ __('general.no_employees') }}</h3>
                    </div>
                @endif
            @endif
        </div>
    </section>

    <x-footer/>
@endsection

