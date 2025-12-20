<div class="mb-2">
    <label class="form-label">{{ __('الاسم') }}</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
<div class="mb-2">
    <label class="form-label">{{ __('الهاتف') }}</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}" required>
    @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
<div class="mb-2">
    <label class="form-label">{{ __('البريد') }}</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
    @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
<div class="mb-2">
    <label class="form-label">{{ __('العنوان') }}</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $user->address ?? '') }}">
    @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
<div class="mb-2">
    <label class="form-label">{{ __('الدور') }}</label>
    <select name="role" class="form-select" required>
        @foreach($roles as $roleName)
            <option value="{{ $roleName }}">{{ $roleName }}</option>
        @endforeach
    </select>
    @error('role')<div class="text-danger small">{{ $message }}</div>@enderror
</div>

