<?php

namespace App\Livewire;

use App\Models\EmployeeProfile;
use LivewireUI\Modal\ModalComponent;

class ViewEmployeeProfileModal extends ModalComponent
{
    public $employee;

    public function mount($employeeId)
    {
        $this->employee = EmployeeProfile::with('user', 'jobApplications.jobPosting')->findOrFail($employeeId);
    }

    public function render()
    {
        return view('livewire.view-employee-profile-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}
