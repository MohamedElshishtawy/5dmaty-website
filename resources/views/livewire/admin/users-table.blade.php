<div>
    <div class="d-flex align-items-center gap-2 mb-3 justify-content-between">
        <input type="text" class="form-control form-control-sm" placeholder="{{ __('ابحث بالاسم أو الهاتف') }}"
            wire:model.debounce.400ms="search">
        <button class="btn btn-primary btn-sm text-nowrap"
            wire:click="$dispatch('openModal', {'component': 'create-edit-user-modal'})">{{ __('مستخدم جديد') }}</button>
    </div>

    <div class="table-responsive">
        <table class="table table-sm align-middle">
            <thead>
                <tr>
                    <th>{{ __('الاسم') }}</th>
                    <th>{{ __('الهاتف') }}</th>
                    <th class="text-nowrap">{{ __('الدور') }}</th>
                    <th class="text-end">{{ __('الإجراءات') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            @php $role = strtolower($user->role_name ?? 'user'); @endphp
                            <span class="badge bg-success">{{ __('general.' . $role) }}</span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-outline-secondary btn-sm"
                                wire:click="$dispatch('openModal', {'component': 'create-edit-user-modal', 'arguments': {'user': {{ $user->id }} } })">
                                {{ __('تعديل') }}
                            </button>
                            <button class="btn btn-outline-danger btn-sm" wire:click="destroy({{ $user->id }})"
                                onclick="return confirm('{{ __('تأكيد الحذف؟') }}')">{{ __('حذف') }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $users->links() }}
    </div>
</div>