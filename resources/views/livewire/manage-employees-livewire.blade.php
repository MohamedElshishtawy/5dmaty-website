<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ __('general.employee_management') }}</h2>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ __('general.employees') }}</span>
            <div class="d-flex gap-2 align-items-center">
                <label class="mb-0 me-2">{{ __('general.filter_by') }}:</label>
                <select wire:model.live="visibility" class="form-select form-select-sm" style="width: auto;">
                    <option value="all">{{ __('general.all') }}</option>
                    <option value="public">{{ __('general.public') }}</option>
                    <option value="private">{{ __('general.private') }}</option>
                </select>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>{{ __('general.name') }}</th>
                        <th>{{ __('general.age') }}</th>
                        <th>{{ __('general.desired_position') }}</th>
                        <th>{{ __('general.residence') }}</th>
                        <th>{{ __('general.education') }}</th>
                        <th>{{ __('general.visibility') }}</th>
                        <th>{{ __('general.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>
                                <strong>{{ $employee->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $employee->user->email }}</small>
                            </td>
                            <td>{{ $employee->age ? $employee->age . ' ' . __('general.years') : '-' }}</td>
                            <td>{{ $employee->desired_position ?? '-' }}</td>
                            <td>{{ $employee->residence ?? '-' }}</td>
                            <td>{{ $employee->education ?? '-' }}</td>
                            <td>
                                @if($employee->is_public)
                                    <span class="badge bg-success">{{ __('general.public') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('general.private') }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" style="direction: ltr" role="group">
                                    <button class="btn btn-{{$employee->is_public ? 'warning' : 'success'}} btn-sm" 
                                            wire:click="togglePublic({{$employee->id}})"
                                            title="{{ $employee->is_public ? __('general.make_private') : __('general.make_public') }}">
                                        <i class="fas fa-{{$employee->is_public ? 'pause' : 'play'}}"></i>
                                    </button>
                                    
                                    <button class="btn btn-info btn-sm" 
                                            onclick="Livewire.dispatch('openModal', {component: 'view-employee-profile-modal', arguments: {employeeId: {{$employee->id}}}})"
                                            title="{{ __('general.view') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    
                                    <button class="btn btn-danger btn-sm" 
                                            wire:confirm="{{__('general.confirm_delete')}}" 
                                            wire:click="delete({{$employee->id}})"
                                            title="{{ __('general.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">{{__('general.no_employees')}}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $employees->links() }}
        </div>
    </div>
</div>
