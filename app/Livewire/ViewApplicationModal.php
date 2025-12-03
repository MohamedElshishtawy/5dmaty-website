<?php

namespace App\Livewire;

use App\Models\JobApplication;
use LivewireUI\Modal\ModalComponent;

class ViewApplicationModal extends ModalComponent
{
    public $application;

    public function mount($application)
    {
        if (is_numeric($application)) {
            $this->application = JobApplication::with('jobPosting')->findOrFail($application);
        } else {
            $this->application = $application;
        }
    }

    public function acceptApplication()
    {
        $this->application->update([
            'status' => JobApplication::STATUS_ACCEPTED
        ]);
        
        session()->flash('message', __('general.application_accepted'));
        $this->dispatch('closeModal');
        $this->dispatch('applicationUpdated');
    }

    public function rejectApplication()
    {
        $this->application->update([
            'status' => JobApplication::STATUS_REJECTED
        ]);
        
        session()->flash('message', __('general.application_rejected'));
        $this->dispatch('closeModal');
        $this->dispatch('applicationUpdated');
    }

    public function activateApplication()
    {
        $this->application->update(['is_active' => true]);
        
        session()->flash('message', __('general.application_activated'));
        $this->dispatch('closeModal');
        $this->dispatch('applicationUpdated');
    }

    public function deactivateApplication()
    {
        $this->application->update(['is_active' => false]);
        
        session()->flash('message', __('general.application_deactivated'));
        $this->dispatch('closeModal');
        $this->dispatch('applicationUpdated');
    }

    public function render()
    {
        return view('livewire.view-application-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}