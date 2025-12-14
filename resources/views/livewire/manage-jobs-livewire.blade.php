<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h2 class="card-title m-0">{{__('general.manage')}} {{__('general.jobs')}}</h2>
            <x-spinner />
        </div>

        <button class="btn btn-primary"
            wire:click="$dispatch('openModal', {'component': 'create-edit-job-modal'})">{{__('general.add_job')}}</button>

    </div>
    <div class="card-body">
        <div class="d-flex gap-2 align-items-center">
            <i class="fas fa-filter"></i>
            <span>{{ __('general.filter_by') }}</span>
            <select wire:model.live="status" class="form-select form-select-sm" style="width: auto;">
                <option value="all">{{ __('general.all') }}</option>
                <option value="pending">{{ __('general.pending_review') }}</option>
                <option value="approved">{{ __('general.approved') }}</option>
                <option value="rejected">{{ __('general.rejected') }}</option>
            </select>
        </div>
        <hr>
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="{{__('general.close')}}"></button>
            </div>
        @endif

        <div class="row g-3">
            @forelse($jobs as $job)
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="card-title mb-0">
                                    <a href="{{ route('jobs.show', $job->slug) }}" target="_blank"
                                        class="text-decoration-none">
                                        {{ $job->title }}
                                    </a>
                                </h5>
                                @if($job->status === 'pending')
                                    <span class="badge bg-warning">{{ __('general.pending_review') }}</span>
                                @elseif($job->status === 'approved')
                                    <span class="badge bg-success">{{ __('general.approved') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('general.rejected') }}</span>
                                @endif
                            </div>
                            <div class="btn-group btn-group-sm" style="direction: ltr" role="group">
                                @if($job->status === 'pending')
                                    <button class="btn btn-success btn-sm" wire:click="approve({{$job->id}})"
                                        title="{{ __('general.approve') }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" wire:click="reject({{$job->id}})"
                                        title="{{ __('general.reject') }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif

                                @if($job->status === 'approved')
                                    <button class="btn btn-{{$job->is_active ? 'warning' : 'success'}} btn-sm"
                                        wire:click="toggleActive({{$job->id}})"
                                        title="{{ $job->is_active ? __('general.close_job') : __('general.open_job') }}">
                                        <i class="fas fa-{{$job->is_active ? 'pause' : 'play'}}"></i>
                                    </button>
                                @endif

                                <button class="btn btn-info btn-sm"
                                    wire:click="$dispatch('openModal', {'component': 'create-edit-job-modal', 'arguments': {'job': {{$job->id}}} })"
                                    title="{{ __('general.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" wire:confirm="{{__('general.confirm_delete')}}"
                                    wire:click="delete({{$job->id}})" title="{{ __('general.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">{{ __('general.shop_name') }}:</small>
                                    <p class="mb-1">{{ $job->shop_name ?? '-' }}</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">{{ __('general.owner') }}:</small>
                                    <p class="mb-1">{{ $job->user->name }}</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">{{ __('general.active') }}:</small>
                                    <p class="mb-1">
                                        @if($job->is_active)
                                            <span class="badge bg-success">{{ __('general.active') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">{{ __('general.applications') }}:</small>
                                    <p class="mb-1">
                                        <span class="badge bg-info">{{ $job->applications->count() }}</span>
                                    </p>
                                </div>
                            </div>

                            @if($job->applications->isNotEmpty())
                                <hr>
                                <div class="mt-3">
                                    <h6 class="mb-3">{{ __('general.applications') }}:</h6>
                                    <div class="row g-2">
                                        @foreach($job->applications as $application)
                                            <div class="col-12">
                                                <div class="card card-body bg-light">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <strong>{{ $application->name }}</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <small class="text-muted">{{ __('general.phone') }}:</small>
                                                            {{ $application->whatsapp_phone }}
                                                        </div>
                                                        <div class="col-md-3">
                                                            @if($application->is_active)
                                                                <span class="badge bg-success">{{ __('general.active') }}</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="btn-group btn-group-sm" style="direction: ltr" role="group">
                                                                <button class="btn btn-info btn-sm"
                                                                    wire:click="$dispatch('openModal', {'component': 'view-application-modal', 'arguments': {'application': {{$application->id}}} })"
                                                                    title="{{ __('general.view') }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button class="btn btn-danger btn-sm"
                                                                    wire:confirm="{{__('general.confirm_delete')}}"
                                                                    wire:click="deleteApplication({{$application->id}})"
                                                                    title="{{ __('general.delete') }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                                @if($application->is_active)
                                                                    <button class="btn btn-secondary btn-sm"
                                                                        wire:click="deactivateApplication({{$application->id}})"
                                                                        title="{{ __('general.deactivate') }}">
                                                                        <i class="fas fa-pause"></i>
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-success btn-sm"
                                                                        wire:click="activateApplication({{$application->id}})"
                                                                        title="{{ __('general.activate') }}">
                                                                        <i class="fas fa-play"></i>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <hr>
                                <p class="text-muted mb-0">{{ __('general.no_applications_yet') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">{{ __('general.no_jobs') }}</h5>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>