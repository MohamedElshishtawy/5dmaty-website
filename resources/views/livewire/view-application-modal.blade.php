<x-modal-card :title="__('general.view_application') . ' - ' . $application->name">
    <x-slot:body>
        <div class="row">
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.name') }}:</strong>
                <p>{{ $application->name }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.age') }}:</strong>
                <p>{{ $application->age ? $application->age . ' ' . __('general.years') : '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.education') }}:</strong>
                <p>{{ $application->education ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.marital_status') }}:</strong>
                <p>{{ $application->marital_status ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.military_status') }}:</strong>
                <p>{{ $application->military_status ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.residence') }}:</strong>
                <p>{{ $application->residence ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.desired_position') }}:</strong>
                <p>{{ $application->desired_position ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.whatsapp_phone') }}:</strong>
                <p>{{ $application->whatsapp_phone ?? '-' }}</p>
            </div>
            <div class="col-12 mb-3">
                <strong>{{ __('general.about') }}:</strong>
                <p>{{ $application->about ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.status') }}:</strong>
                <p>
                    @switch($application->status)
                        @case('pending')
                            <span class="badge bg-warning">{{ __('general.pending') }}</span>
                            @break
                        @case('accepted')
                            <span class="badge bg-success">{{ __('general.accepted') }}</span>
                            @break
                        @case('rejected')
                            <span class="badge bg-danger">{{ __('general.rejected') }}</span>
                            @break
                        @default
                            <span class="badge bg-secondary">{{ ucfirst($application->status) }}</span>
                    @endswitch
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.active_status') }}:</strong>
                <p>
                    @if($application->is_active)
                        <span class="badge bg-success">{{ __('general.active') }}</span>
                    @else
                        <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                    @endif
                </p>
            </div>
            @if($application->jobPosting)
                <div class="col-12 mb-3">
                    <strong>{{ __('general.job_posting') }}:</strong>
                    <p>{{ $application->jobPosting->title }}</p>
                    <small class="text-muted">{{ $application->jobPosting->description ?? '' }}</small>
                </div>
            @endif
            <div class="col-12 mb-3">
                <strong>{{ __('general.application_date') }}:</strong>
                <p>{{ $application->created_at ? $application->created_at->format('Y-m-d H:i:s') : '-' }}</p>
            </div>
        </div>
    </x-slot:body>

    <x-slot:footer>
        <div class="d-flex justify-content-between">
            <div class="btn-group" role="group" style="direction: ltr">
                @if($application->status !== 'accepted')
                    <button type="button" class="btn btn-success btn-sm" 
                            wire:click="acceptApplication"
                            wire:confirm="{{ __('general.confirm_accept') }}">
                        <i class="fas fa-check"></i> {{ __('general.accept') }}
                    </button>
                @endif
                @if($application->status !== 'rejected')
                    <button type="button" class="btn btn-danger btn-sm" 
                            wire:click="rejectApplication"
                            wire:confirm="{{ __('general.confirm_reject') }}">
                        <i class="fas fa-times"></i> {{ __('general.reject') }}
                    </button>
                @endif
                @if($application->is_active)
                    <button type="button" class="btn btn-secondary btn-sm" 
                            wire:click="deactivateApplication">
                        <i class="fas fa-pause"></i> {{ __('general.deactivate') }}
                    </button>
                @else
                    <button type="button" class="btn btn-info btn-sm" 
                            wire:click="activateApplication">
                        <i class="fas fa-play"></i> {{ __('general.activate') }}
                    </button>
                @endif
            </div>
            <button type="button" class="btn btn-secondary" wire:click="$dispatch('closeModal')">
                {{ __('general.close') }}
            </button>
        </div>
    </x-slot:footer>
</x-modal-card>