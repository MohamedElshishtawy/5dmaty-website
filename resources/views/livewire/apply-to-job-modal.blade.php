<x-modal-card :title="__('general.apply_now')">
    <x-slot:body>
        @if($job)
            <div class="mb-3">
                <h6 class="fw-bold">{{ $job->title }}</h6>
                @if($job->shop_name)
                    <p class="text-muted mb-2">
                        <i class="fas fa-store me-1"></i>
                        {{ $job->shop_name }}
                    </p>
                @endif
            </div>
        @endif

        <form wire:submit.prevent="apply" class="space-y-4">
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('general.name') }}</label>
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       wire:model="name"
                       placeholder="{{ __('general.name') }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Age -->
            <div class="mb-3">
                <label for="age" class="form-label">{{ __('general.age') }}</label>
                <input type="number"
                       class="form-control @error('age') is-invalid @enderror"
                       id="age"
                       wire:model="age"
                       placeholder="{{ __('general.age') }}"
                       min="16"
                       max="100">
                @error('age')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Education -->
            <div class="mb-3">
                <label for="education" class="form-label">{{ __('general.education') }}</label>
                <input type="text"
                       class="form-control @error('education') is-invalid @enderror"
                       id="education"
                       wire:model="education"
                       placeholder="{{ __('general.education') }}">
                @error('education')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Marital Status -->
            <div class="mb-3">
                <label for="marital_status" class="form-label">{{ __('general.marital_status') }}</label>
                <input type="text"
                       class="form-control @error('marital_status') is-invalid @enderror"
                       id="marital_status"
                       wire:model="marital_status"
                       placeholder="{{ __('general.marital_status') }}">
                @error('marital_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Military Status -->
            <div class="mb-3">
                <label for="military_status" class="form-label">{{ __('general.military_status') }}</label>
                <input type="text"
                       class="form-control @error('military_status') is-invalid @enderror"
                       id="military_status"
                       wire:model="military_status"
                       placeholder="{{ __('general.military_status') }}">
                @error('military_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Residence -->
            <div class="mb-3">
                <label for="residence" class="form-label">{{ __('general.residence') }}</label>
                <input type="text"
                       class="form-control @error('residence') is-invalid @enderror"
                       id="residence"
                       wire:model="residence"
                       placeholder="{{ __('general.residence') }}">
                @error('residence')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Desired Position -->
            <div class="mb-3">
                <label for="desired_position" class="form-label">{{ __('general.desired_position') }}</label>
                <input type="text"
                       class="form-control @error('desired_position') is-invalid @enderror"
                       id="desired_position"
                       wire:model="desired_position"
                       placeholder="{{ __('general.desired_position') }}">
                @error('desired_position')
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

            <!-- About -->
            <div class="mb-3">
                <label for="about" class="form-label">{{ __('general.about_employee') }}</label>
                <textarea class="form-control @error('about') is-invalid @enderror"
                          id="about"
                          rows="4"
                          wire:model="about"
                          placeholder="{{ __('general.about_yourself') }}"></textarea>
                @error('about')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </x-slot:body>

    <x-slot:footer>
        <div class="d-flex justify-content-end gap-2">
            <x-btn-cancel wire:click="$dispatch('closeModal')" />
            <x-btn-save wire:click="apply" wire:loading.attr="disabled" />
        </div>
    </x-slot:footer>
</x-modal-card>
