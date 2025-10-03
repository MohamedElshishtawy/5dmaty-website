<div>
    <div class="d-flex align-items-center gap-2 mb-3">
        <input type="text" class="form-control form-control-sm" placeholder="{{ __('ابحث بالاسم أو الهاتف') }}" wire:model.debounce.400ms="search">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.create') }}">{{ __('مستخدم جديد') }}</a>
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
                        <select class="form-select form-select-sm" wire:change="updateRole({{ $user->id }}, $event.target.value)">
                            @foreach($roles as $roleName)
                                <option value="{{ $roleName }}" @selected(optional($user->roles->first())->name === $roleName)>{{ __($roleName) }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-end">
                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.users.edit', $user) }}">{{ __('تعديل') }}</a>
                        <button class="btn btn-outline-danger btn-sm" wire:click="destroy({{ $user->id }})" onclick="return confirm('{{ __('تأكيد الحذف؟') }}')">{{ __('حذف') }}</button>
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
