<x-modal-card :title="$jobId ? __('general.edit_job') : __('general.add_job')">
    <x-slot:body>
        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Job Title -->
            <div class="mb-3">
                <label for="title" class="form-label">{{ __('general.job_title') }}</label>
                <input type="text"
                       class="form-control @error('title') is-invalid @enderror"
                       id="title"
                       wire:model="title"
                       placeholder="{{ __('general.job_title') }}"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Job Description -->
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('general.job_description') }}</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description"
                          rows="4"
                          wire:model="description"
                          placeholder="{{ __('general.job_description') }}"></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shop Name -->
            <div class="mb-3">
                <label for="shop_name" class="form-label">{{ __('general.shop_name') }}</label>
                <input type="text"
                       class="form-control @error('shop_name') is-invalid @enderror"
                       id="shop_name"
                       wire:model="shop_name"
                       placeholder="{{ __('general.shop_name') }}">
                @error('shop_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shop Address -->
            <div class="mb-3">
                <label for="shop_address" class="form-label">{{ __('general.shop_address') }}</label>
                <input type="text"
                       class="form-control @error('shop_address') is-invalid @enderror"
                       id="shop_address"
                       wire:model="shop_address"
                       placeholder="{{ __('general.shop_address') }}">
                @error('shop_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- WhatsApp Phone -->
            <div class="mb-3">
                <label for="whatsapp_phone" class="form-label">{{ __('general.whatsapp_phone') }}</label>
                <input type="text"
                       class="form-control @error('whatsapp_phone') is-invalid @enderror"
                       id="whatsapp_phone"
                       wire:model="whatsapp_phone"
                       placeholder="{{ __('general.whatsapp_phone') }}">
                @error('whatsapp_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if(!$jobId && !Auth::user()->hasRole(['admin', 'superadmin']))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ __('general.job_pending_note') }}
                </div>
            @endif
        </form>
    </x-slot:body>

    <x-slot:footer>
        <div class="d-flex justify-content-end gap-2">
            <x-btn-cancel wire:click="$dispatch('closeModal')" />
            <x-btn-save wire:click="save" wire:loading.attr="disabled" />
        </div>
    </x-slot:footer>
</x-modal-card>
