<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h2 class="card-title">{{ __('general.categories') }}</h2>
        <div>
            <button class="btn btn-primary" wire:click="$dispatch('openModal', {'component': 'create-edit-category-modal'})">{{ __('general.add_category') }}</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table" >
            <thead>
            <th>{{ __('general.name') }}</th>
            <th>{{ __('general.description') }}</th>
            <th>{{ __('general.actions') }}</th>
            </thead>

            <tbody>
            @foreach($categories as $category)
                <!-- Row 1: Category data -->
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <div class="btn-group" style="direction: ltr">
                            <button class="btn btn-sm btn-info" wire:click="$dispatch('openModal', {'component': 'create-edit-category-modal', 'arguments': {'category': {{$category->id}}} })">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" wire:confirm="{{ __('general.confirm_delete') }}" wire:click="delete({{$category->id}})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Row 2: Services table -->
                <tr>
                    <td colspan="4" class="bg-light">
                        <div class="p-2">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small">{{ __('general.services') }}: {{ $category->services->count() }}</span>
                                <button class="btn btn-sm btn-primary" wire:click="$dispatch('openModal', {'component': 'create-edit-service-modal', 'arguments': {'category_id': {{ $category->id }} } })">
                                    {{ __('general.add_service') }}
                                </button>
                            </div>
                            @if($category->services->count() === 0)
                                
                            @else
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0">
                                        <thead>
                                        <tr>
                                            <th>{{ __('general.icon_image') }}</th>
                                            <th>{{ __('general.service_name') }}</th>
                                            <th>{{ __('general.service_price') }}</th>
                                            <th>{{ __('general.status') }}</th>
                                            <th class="text-end">{{ __('general.actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($category->services as $service)
                                            <tr>
                                                <td>
                                                    @php
                                                        $thumb = $service->icon_image
                                                            ? asset('storage/' . $service->icon_image)
                                                            : asset('images/black-5dmaty.svg');
                                                    @endphp
                                                    <img src="{{ $thumb }}" alt="{{ $service->name }}" style="width:40px;height:40px;object-fit:cover;border-radius:8px;">
                                                </td>
                                                <td>{{ $service->name }}</td>
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
                                                    <div class="btn-group float-end" style="direction: ltr">
                                                        <button class="btn btn-sm btn-info" title="{{__('general.edit')}}" wire:click="$dispatch('openModal', {'component': 'create-edit-service-modal', 'arguments': {'service': {{ $service->id }} } })">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" title="{{__('general.delete')}}" wire:click="deleteService({{ $service->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
