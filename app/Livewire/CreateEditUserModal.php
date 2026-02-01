<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class CreateEditUserModal extends ModalComponent
{
    public ?int $userId = null;
    public string $name = '';
    public string $phone = '';
    public ?string $email = null;
    public ?string $address = null;
    public string $role = 'user';
    public ?string $password = null;

    public function mount($user = null): void
    {
        if ($user) {
            if (is_numeric($user)) {
                $model = User::findOrFail($user);
            } else {
                $model = $user;
            }

            $this->userId = $model->id;
            $this->name = (string)$model->name;
            $this->phone = (string)$model->phone;
            $this->email = $model->email;
            $this->address = $model->address;
            $this->role = optional($model->roles->first())->name ?? 'user';
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'phone')->ignore($this->userId),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'address' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'string'],
            'password' => [$this->userId ? 'nullable' : 'required', 'string', 'min:8'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email ?: null,
                'address' => $this->address ?: null,
            ]);
            if ($this->password) {
                $user->update(['password' => bcrypt($this->password)]);
            }
        } else {
            $user = User::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email ?: null,
                'address' => $this->address ?: null,
                'password' => $this->password ? bcrypt($this->password) : bcrypt('12345678'),
            ]);
        }

        $role = Role::firstOrCreate(['name' => $this->role, 'guard_name' => 'web']);
        $user->syncRoles([$role]);

        $this->dispatch('closeModal');
        $this->dispatch('userUpdated');
    }

    public function render()
    {
        $roles = Role::pluck('name')->toArray();
        return view('livewire.create-edit-user-modal', compact('roles'));
    }
}


















