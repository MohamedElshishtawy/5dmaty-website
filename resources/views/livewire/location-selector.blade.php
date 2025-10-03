<div>
    <div class="row mb-3">
        <label class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>
        <div class="col-md-6">
            <select class="form-select" wire:model="country" disabled>
                @foreach($countries as $c)
                    <option value="{{ $c['code'] }}">{{ $c['name'] }}</option>
                @endforeach
            </select>
            <input type="hidden" name="country" value="{{ collect($countries)->firstWhere('code', $country)['name'] ?? 'Egypt' }}">
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-form-label text-md-end">{{ __('Governorate') }}</label>
        <div class="col-md-6">
            <select name="government" class="form-select @error('government') is-invalid @enderror" wire:model="government">
                <option value="">{{ __('Choose governorate') }}</option>
                @foreach($governorates as $gov)
                    <option value="{{ $gov }}">{{ $gov }}</option>
                @endforeach
            </select>
            @error('government')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>
        <div class="col-md-6">
            <select name="city" class="form-select @error('city') is-invalid @enderror" wire:model="city" @disabled(empty($cities))>
                <option value="">{{ __('Choose city') }}</option>
                @foreach($cities as $c)
                    <option value="{{ $c }}">{{ $c }}</option>
                @endforeach
            </select>
            @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>



