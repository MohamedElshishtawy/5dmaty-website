<?php

namespace App\Livewire;

use App\Models\EmployeeProfile;
use Livewire\Component;
use Livewire\WithPagination;

class ManageEmployeesLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['employeeUpdated' => '$refresh'];

    public $visibility = 'all';

    public function updatingVisibility()
    {
        $this->resetPage();
    }

    public function togglePublic($id)
    {
        $employee = EmployeeProfile::find($id);
        if ($employee) {
            $employee->update(['is_public' => !$employee->is_public]);
            session()->flash('message', __('general.massages.updated'));
        }
    }

    public function delete($id)
    {
        $employee = EmployeeProfile::find($id);
        if ($employee) {
            $employee->delete();
            session()->flash('message', __('general.massages.deleted'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function render()
    {
        $query = EmployeeProfile::with('user');

        if ($this->visibility === 'public') {
            $query->where('is_public', true);
        } elseif ($this->visibility === 'private') {
            $query->where('is_public', false);
        }

        $employees = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.manage-employees-livewire', ['employees' => $employees]);
    }
}
