<x-modal-card :title="$service->id ? __('general.edit_service') : __('general.add_service')">
    <x-slot:body>
        <form wire:submit.prevent="save" class="space-y-4">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('general.service_name') }}</label>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="{{ __('general.service_name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">{{ __('general.categories') }}</label>
                <select id="category" class="form-select @error('category_id') is-invalid @enderror" wire:model="category_id" required>
                    <option value="">{{ __('general.select') }}</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('general.service_description') }}</label>
                <textarea id="description" rows="3" class="form-control @error('description') is-invalid @enderror" wire:model="description" placeholder="{{ __('general.service_description') }}"></textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">{{ __('general.service_price') }} ({{ __('general.optional') }})</label>
                <input type="number" step="0.01" id="price" class="form-control @error('price') is-invalid @enderror" wire:model="price" placeholder="{{ __('general.service_price') }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon_image_file" class="form-label">{{ __('general.icon_image') }} ({{ __('general.optional') }})</label>
                <input type="file" id="icon_image_file" class="form-control @error('icon_image_file') is-invalid @enderror" wire:model="icon_image_file" accept="image/*">
                @error('icon_image_file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if($service->id && $service->icon_image)
                    <div class="mt-2 d-flex align-items-center gap-2">
                        <img src="{{ asset('storage/' . $service->icon_image) }}" alt="{{ $service->name }}" style="width: 56px; height: 56px; object-fit: cover; border-radius: 8px;">
                        <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deleteIcon">{{ __('general.delete') }}</button>
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="media_files" class="form-label">{{ __('general.upload_media') }} ({{ __('general.optional') }})</label>
                <input type="file" id="media_files" class="form-control @error('media_files.*') is-invalid @enderror" wire:model="media_files" multiple accept="image/*">
                @error('media_files.*')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" wire:model="is_active">
                <label class="form-check-label" for="is_active">{{ __('general.active') }}</label>
            </div>

            <div class="d-grid">
                <button class="btn btn-primary" type="submit">{{ __('general.save') }}</button>
            </div>
        </form>
    </x-slot:body>
</x-modal-card>




