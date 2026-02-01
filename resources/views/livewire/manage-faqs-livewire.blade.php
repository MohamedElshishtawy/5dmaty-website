<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h2 class="card-title m-0">{{__('general.faq_management')}}</h2>
            <x-spinner />
        </div>
        <button class="btn btn-primary" wire:click="$dispatch('openModal', {'component': 'create-edit-faq-modal'})">
            {{__('general.add_faq')}}
        </button>
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
                        <th>{{__('general.question')}}</th>
                        <th>{{__('general.answer')}}</th>
                        <th>{{__('general.order')}}</th>
                        <th>{{__('general.status')}}</th>
                        <th>{{__('general.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                        <tr>
                            <td class="fw-bold">{{ $faq->question }}</td>
                            <td class="text-muted" style="max-width: 420px;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($faq->answer), 100) }}
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $faq->order }}</span>
                            </td>
                            <td>
                                @if($faq->is_active)
                                    <span class="badge bg-success">{{ __('general.active') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" style="direction: ltr" role="group">
                                    <button class="btn btn-{{$faq->is_active ? 'warning' : 'success'}} btn-sm" 
                                            wire:click="toggleActive({{$faq->id}})"
                                            title="{{ $faq->is_active ? __('general.hide') : __('general.show') }}">
                                        <i class="fas fa-{{$faq->is_active ? 'eye-slash' : 'eye'}}"></i>
                                    </button>
                                    <button class="btn btn-info btn-sm" 
                                            wire:click="$dispatch('openModal', {'component': 'create-edit-faq-modal', 'arguments': {'faq': {{$faq->id}}} })"
                                            title="{{ __('general.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" 
                                            wire:confirm="{{__('general.confirm_delete')}}" 
                                            wire:click="delete({{$faq->id}})"
                                            title="{{ __('general.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">{{__('general.no_faqs')}}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>





















