<x-modal-card :title="__('general.employee_profile') . ' - ' . $employee->name">
    <x-slot:body>
        <div class="row">
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.name') }}:</strong>
                <p>{{ $employee->name }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.age') }}:</strong>
                <p>{{ $employee->age ? $employee->age . ' ' . __('general.years') : '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.education') }}:</strong>
                <p>{{ $employee->education ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.marital_status') }}:</strong>
                <p>{{ $employee->marital_status ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.military_status') }}:</strong>
                <p>{{ $employee->military_status ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.residence') }}:</strong>
                <p>{{ $employee->residence ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.desired_position') }}:</strong>
                <p>{{ $employee->desired_position ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>{{ __('general.whatsapp_phone') }}:</strong>
                <p>{{ $employee->whatsapp_phone ?? '-' }}</p>
            </div>
            <div class="col-12 mb-3">
                <strong>{{ __('general.about') }}:</strong>
                <p>{{ $employee->about ?? '-' }}</p>
            </div>
            <div class="col-12 mb-3">
                <strong>{{ __('general.visibility') }}:</strong>
                <p>
                    @if($employee->is_public)
                        <span class="badge bg-success">{{ __('general.public') }}</span>
                    @else
                        <span class="badge bg-secondary">{{ __('general.private') }}</span>
                    @endif
                </p>
            </div>
            <div class="col-12 mb-3">
                <strong>{{ __('general.user_account') }}:</strong>
                <p>{{ $employee->user->name }} ({{ $employee->user->email }})</p>
            </div>
        </div>

        @if($employee->jobApplications->count() > 0)
            <hr>
            <h5 class="mb-3">{{ __('general.applications') }} ({{ $employee->jobApplications->count() }})</h5>
            <div class="list-group">
                @foreach($employee->jobApplications as $application)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $application->jobPosting->title }}</h6>
                                <small class="text-muted">{{ $application->created_at->diffForHumans() }}</small>
                            </div>
                            <a href="{{ route('jobs.show', $application->jobPosting->slug) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-primary">
                                {{ __('general.view_job') }}
                            </a>
                        </div>
                        @if($application->notes)
                            <p class="mb-0 mt-2"><strong>{{ __('general.notes') }}:</strong> {{ $application->notes }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </x-slot:body>

    <x-slot:footer>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary" wire:click="$dispatch('closeModal')">
                {{ __('general.close') }}
            </button>
        </div>
    </x-slot:footer>
</x-modal-card>
