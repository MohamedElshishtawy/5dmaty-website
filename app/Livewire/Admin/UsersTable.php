<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTable extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updateRole(int $userId, string $roleName): void
    {
        $user = User::findOrFail($userId);
        $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        $user->syncRoles([$role]);
        $this->dispatch('roleUpdated');
    }

    public function destroy(int $userId): void
    {
        $user = User::findOrFail($userId);
        $user->delete();
        $this->dispatch('deleted');
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query()
            ->when($this->search, function ($q) {
                $q->where(function ($qq) {
                    $qq->where('name', 'like', "%{$this->search}%")
                       ->orWhere('phone', 'like', "%{$this->search}%");
                });
            })
            ->orderByDesc('id');

        $users = $query->paginate(10);
        $roles = Role::pluck('name')->toArray();

        return view('livewire.admin.users-table', compact('users', 'roles'));
    }
}
