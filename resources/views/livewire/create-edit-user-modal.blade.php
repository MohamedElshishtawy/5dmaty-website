<x-modal-card :title="$userId ? __('general.edit_user') : __('general.add_user')">
    <x-slot:body>
        <form wire:submit.prevent="save" class="space-y-3">
            <div class="mb-2">
                <label class="form-label">{{ __('general.name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="name" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label class="form-label">{{ __('general.phone') }}</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model.defer="phone" required>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label class="form-label">{{ __('general.email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.defer="email">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label class="form-label">{{ __('general.address') }}</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" wire:model.defer="address">
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label class="form-label">{{ __('general.role') }}</label>
                <select class="form-select @error('role') is-invalid @enderror" wire:model.defer="role" required>
                    @foreach($roles as $roleName)
                        <option value="{{ $roleName }}">{{ __('general.'.$roleName) }}</option>
                    @endforeach
                </select>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </form>
    </x-slot:body>
    <x-slot:footer>
        <div class="d-flex justify-content-end gap-2">
            <x-btn-cancel wire:click="$dispatch('closeModal')" />
            <x-btn-save wire:click="save" wire:loading.attr="disabled" />
        </div>
    </x-slot:footer>
</x-modal-card>

