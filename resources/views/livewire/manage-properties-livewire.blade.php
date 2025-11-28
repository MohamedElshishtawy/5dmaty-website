<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h2 class="card-title">{{__('general.manage')}} {{__('general.properties')}}</h2>
<div>
            <button class="btn btn-primary" wire:click="$dispatch('openModal', {'component': 'create-edit-property-modal'})">{{__('general.add_property')}}</button>
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
                        <th>{{__('general.property_title')}}</th>
                        <th>{{__('general.location')}}</th>
                        <th>{{__('general.price')}}</th>
                        <th>{{__('general.published_at')}}</th>
                        <th>{{__('general.accepted')}}</th>
                        <th>{{__('general.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                        <tr>
                            <td>{{$property->title}}</td>
                            <td>{{$property->location ?? '-'}}</td>
                            <td>{{$property->price ? number_format($property->price, 2) : '-'}}</td>
                            <td>{{$property->created_at->format('Y-m-d')}}</td>
                            <td>
                                <button
                                    class="btn btn-sm {{ $property->is_accepted ? 'btn-success' : 'btn-outline-warning text-dark' }}"
                                    wire:click="toggleAccepted({{$property->id}})"
                                    title="{{ $property->is_accepted ? __('general.accepted') : __('general.pending_review') }}"
                                >
                                    @if($property->is_accepted)
                                        <i class="fas fa-check ms-1"></i> {{ __('general.accepted') }}
                                    @else
                                        <i class="fas fa-hourglass-half ms-1"></i> {{ __('general.pending_review') }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <div class="btn-group" style="direction: ltr">
                                    <button class="btn btn-sm btn-info" wire:click="$dispatch('openModal', {'component': 'create-edit-property-modal', 'arguments': {'property': {{$property->id}}} })">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" wire:confirm="{{__('general.confirm_delete')}}" wire:click="delete({{$property->id}})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">{{__('general.no_properties')}}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
