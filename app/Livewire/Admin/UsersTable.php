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
    protected $listeners = ['userUpdated' => '$refresh'];

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
            ->leftJoin('model_has_roles', function ($join) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                     ->where('model_has_roles.model_type', '=', User::class);
            })
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('users.*', 'roles.name as role_name')
            ->when($this->search, function ($q) {
                $q->where(function ($qq) {
                    $qq->where('users.name', 'like', "%{$this->search}%")
                       ->orWhere('users.phone', 'like', "%{$this->search}%");
                });
            })
            ->orderByRaw("CASE 
                WHEN roles.name = 'superadmin' THEN 1
                WHEN roles.name = 'admin' THEN 2
                WHEN roles.name IS NULL THEN 4
                ELSE 3
            END")
            ->orderBy('users.name');

        $users = $query->paginate(10);

        return view('livewire.admin.users-table', compact('users'));
    }
}
