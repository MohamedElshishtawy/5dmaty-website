<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title">{{ __('general.service_management') }}</h2>
        <div class="d-flex gap-2">
            <select class="form-select" style="min-width: 220px" wire:model.live="selectedCategoryId" aria-label="{{ __('general.filter_by_category') }}">
                <option value="">{{ __('general.all') }}</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary" wire:click="$dispatch('openModal', {'component': 'create-edit-service-modal'})">{{ __('general.add_service') }}</button>
        </div>
    </div>
    <div class="card-body">
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
                    <th>{{ __('general.service_name') }}</th>
                    <th>{{ __('general.categories') }}</th>
                    <th>{{ __('general.service_price') }}</th>
                    <th>{{ __('general.status') }}</th>
                    <th>{{ __('general.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->category?->name }}</td>
                        <td>
                            @if(!is_null($service->price) && (float)$service->price > 0)
                                {{ number_format($service->price, 0) }} {{ __('general.currency') }}
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            @if($service->is_active)
                                <span class="badge bg-success">{{ __('general.active') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" style="direction: ltr">
                                <button class="btn btn-sm btn-info" wire:click="$dispatch('openModal', {'component': 'create-edit-service-modal', 'arguments': {'service': {{ $service->id }} } })">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" wire:confirm="{{ __('general.confirm_delete') }}" wire:click="delete({{ $service->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">{{ __('general.no_services') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>




