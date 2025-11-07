<?php

namespace App\Livewire;

use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ApplyToJobModal extends ModalComponent
{
    public JobPosting $job;
    public $notes;
    public $whatsapp_phone;

    public function rules()
    {
        return [
            'notes' => 'nullable|string',
            'whatsapp_phone' => 'nullable|string|max:20',
        ];
    }

    public function mount(JobPosting $job)
    {
        $this->job = $job;
        
        // Pre-fill whatsapp from profile if exists
        if (Auth::user()->employeeProfile) {
            $this->whatsapp_phone = Auth::user()->employeeProfile->whatsapp_phone;
        }
    }

    public function apply()
    {
        // Check if user has employee profile
        if (!Auth::user()->employeeProfile) {
            session()->flash('error', __('general.employee_profile_required'));
            $this->dispatch('closeModal');
            $this->dispatch('openModal', component: 'upsert-employee-profile-modal');
            return;
        }

        // Check if already applied
        $existing = JobApplication::where('job_posting_id', $this->job->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            session()->flash('info', __('general.already_applied'));
            $this->dispatch('closeModal');
            return;
        }

        $this->validate();

        JobApplication::create([
            'job_posting_id' => $this->job->id,
            'user_id' => Auth::id(),
            'employee_profile_id' => Auth::user()->employeeProfile->id,
            'notes' => $this->notes,
            'whatsapp_phone' => $this->whatsapp_phone,
        ]);

        session()->flash('message', __('general.apply_success'));
        $this->dispatch('closeModal');
        $this->dispatch('applicationSubmitted');
    }

    public function render()
    {
        return view('livewire.apply-to-job-modal');
    }
}
