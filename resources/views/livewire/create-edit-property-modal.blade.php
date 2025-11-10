<x-modal-card :title="$property->id ? __('general.edit_property') : __('general.add_property')">
    <x-slot:body>
        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Property Title -->
            <div class="mb-3">
                <label for="title" class="form-label">{{ __('general.property_title') }}</label>
                <input type="text"
                       class="form-control @error('title') is-invalid @enderror"
                       id="title"
                       wire:model="title"
                       placeholder="{{ __('general.property_title') }}"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Property Description -->
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('general.property_description') }}</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description"
                          rows="3"
                          wire:model="description"
                          placeholder="{{ __('general.property_description') }}"></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="price" class="form-label">{{ __('general.price') }}</label>
                <input type="number"
                       step="0.01"
                       class="form-control @error('price') is-invalid @enderror"
                       id="price"
                       wire:model="price"
                       placeholder="{{ __('general.price') }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Property Type -->
            <div class="mb-3">
                <label class="form-label">{{ __('general.property_type') }}</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input @error('property_type') is-invalid @enderror"
                               type="radio"
                               id="type_sale"
                               value="sale"
                               wire:model="property_type"
                               required>
                        <label class="form-check-label" for="type_sale">{{ __('general.sale') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('property_type') is-invalid @enderror"
                               type="radio"
                               id="type_rent"
                               value="rent"
                               wire:model="property_type"
                               required>
                        <label class="form-check-label" for="type_rent">{{ __('general.rent') }}</label>
                    </div>
                </div>
                @error('property_type')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Property Status -->
            <div class="mb-3">
                <label for="property_status" class="form-label">{{ __('general.property_status') }}</label>
                <select id="property_status"
                        class="form-select @error('property_status') is-invalid @enderror"
                        wire:model="property_status"
                        required>
                    <option value="active">{{ __('general.status_active') }}</option>
                    <option value="sold">{{ __('general.status_sold') }}</option>
                    <option value="inactive">{{ __('general.status_inactive') }}</option>
                </select>
                @error('property_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">{{ __('general.location') }}</label>
                <input type="text"
                       class="form-control @error('location') is-invalid @enderror"
                       id="location"
                       wire:model="location"
                       placeholder="{{ __('general.location') }}">
                @error('location')
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

            <!-- Published At -->
            <div class="mb-3">
                <label for="published_at" class="form-label">{{ __('general.published_at') }}</label>
                <input type="date"
                       class="form-control @error('published_at') is-invalid @enderror"
                       id="published_at"
                       wire:model="published_at">
                @error('published_at')
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
                       accept="image/*">
                @error('media_files.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">{{ __('general.upload_media_help', ['formats' => 'JPG, PNG, GIF, WEBP']) }}</div>
</div>

            <!-- Existing Media Display -->
            @if($property->id && $medias->count() > 0)
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
