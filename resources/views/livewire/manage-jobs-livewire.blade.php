<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h2 class="card-title m-0">{{__('general.manage')}} {{__('general.jobs')}}</h2>
            <x-spinner />
        </div>
       
        <button class="btn btn-primary" wire:click="$dispatch('openModal', {'component': 'create-edit-job-modal'})">{{__('general.add_job')}}</button>

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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{__('general.close')}}"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{__('general.job_title')}}</th>
                        <th>{{__('general.shop_name')}}</th>
                        <th>{{__('general.owner')}}</th>
                        <th>{{__('general.status')}}</th>
                        <th>{{__('general.active')}}</th>
                        <th>{{__('general.applications')}}</th>
                        <th>{{__('general.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                        <tr>
                            <td>
                                <a href="{{ route('jobs.show', $job->slug) }}" target="_blank">
                                    {{ $job->title }}
                                </a>
                            </td>
                            <td>{{ $job->shop_name ?? '-' }}</td>
                            <td>{{ $job->user->name }}</td>
                            <td>
                                @if($job->status === 'pending')
                                    <span class="badge bg-warning">{{ __('general.pending_review') }}</span>
                                @elseif($job->status === 'approved')
                                    <span class="badge bg-success">{{ __('general.approved') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('general.rejected') }}</span>
                                @endif
                            </td>
                            <td>
                                @if($job->is_active)
                                    <span class="badge bg-success">{{ __('general.active') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $job->applications->count() }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" style="direction: ltr" role="group">
                                    @if($job->status === 'pending')
                                        <button class="btn btn-success btn-sm" 
                                                wire:click="approve({{$job->id}})"
                                                title="{{ __('general.approve') }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" 
                                                wire:click="reject({{$job->id}})"
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
                                    
                                    <button class="btn btn-danger btn-sm" 
                                            wire:confirm="{{__('general.confirm_delete')}}" 
                                            wire:click="delete({{$job->id}})"
                                            title="{{ __('general.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">{{__('general.no_jobs')}}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
