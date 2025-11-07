<x-modal-card :title="__('general.apply_now')">
    <x-slot:body>
        <div class="mb-3">
            <h6 class="fw-bold">{{ $job->title }}</h6>
            @if($job->shop_name)
                <p class="text-muted mb-2">
                    <i class="fas fa-store me-1"></i>
                    {{ $job->shop_name }}
                </p>
            @endif
        </div>

        <form wire:submit.prevent="apply" class="space-y-4">
            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">{{ __('general.notes') }}</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          id="notes"
                          rows="3"
                          wire:model="notes"
                          placeholder="{{ __('general.application_notes_placeholder') }}"></textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">{{ __('general.optional') }}</small>
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
                <small class="text-muted">{{ __('general.optional') }}</small>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                {{ __('general.application_note') }}
            </div>
        </form>
    </x-slot:body>

    <x-slot:footer>
        <div class="d-flex justify-content-end gap-2">
            <x-btn-cancel wire:click="$dispatch('closeModal')" />
            <button type="button" class="btn btn-primary" wire:click="apply" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="apply">
                    <i class="fas fa-paper-plane me-1"></i>
                    {{ __('general.submit_application') }}
                </span>
                <span wire:loading wire:target="apply">
                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                    {{ __('general.loading') }}
                </span>
            </button>
        </div>
    </x-slot:footer>
</x-modal-card>
