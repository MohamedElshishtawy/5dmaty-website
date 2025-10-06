<x-modal-card :title="$category->id ? __('general.edit_category') : __('general.add_category')">
    <x-slot:body>
        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Category Name -->
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('general.category_name') }}</label>
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       wire:model="name"
                       placeholder="{{ __('general.category_name') }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category Description -->
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('general.category_description') }}</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description"
                          rows="3"
                          wire:model="description"
                          placeholder="{{ __('general.category_description') }}"></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Media Upload -->
            <div class="mb-3">
                <label for="media_files" class="form-label">{{ __('general.upload_media') }}</label>
                <input type="file"
                       class="form-control @error('media_files.*') is-invalid @enderror"
                       id="media_files"
                       wire:model="media_files"
                       multiple
                       accept="image/*,video/*">
                @error('media_files.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">{{ __('general.upload_media_help', ['formats' => 'JPG, PNG, GIF, MP4']) }}</div>
            </div>

            <!-- Existing Media Display -->
            @if($category->id && $medias->count() > 0)
                <div class="mb-3">
                    <label class="form-label">{{ __('general.current_media') }}</label>
                    <div class="row g-2">
                        @foreach($medias as $media)
                            <div class="col-auto">
                                <x-img-removable
                                    :src="asset('storage/' . $media->url)"
                                    :media-id="$media->id"
                                    wire:key="media-{{ $media->id }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Loading indicator for file upload -->
            <div wire:loading wire:target="media_files" class="text-center">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="visually-hidden">{{ __('general.loading') }}</span>
                </div>
                {{ __('general.uploading') }}
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
