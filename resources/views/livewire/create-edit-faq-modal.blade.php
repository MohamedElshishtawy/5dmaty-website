<div class="card">
    <div class="card-header">
        <h5 class="m-0">{{ $faqId ? __('general.edit') : __('general.add_faq') }}</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">{{ __('general.question') }}</label>
            <input type="text" class="form-control @error('question') is-invalid @enderror" wire:model.defer="question">
            @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('general.answer') }}</label>
            <textarea rows="5" class="form-control @error('answer') is-invalid @enderror" wire:model.defer="answer"></textarea>
            @error('answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('general.order') }}</label>
            <input type="number" min="0" class="form-control @error('order') is-invalid @enderror" wire:model.defer="order">
            @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end gap-2">
        <button class="btn btn-secondary" wire:click="$dispatch('closeModal')">{{ __('general.close') }}</button>
        <button class="btn btn-primary" wire:click="save">{{ __('general.submit') }}</button>
    </div>
</div>













