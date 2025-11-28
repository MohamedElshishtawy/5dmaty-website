<?php

namespace App\Livewire;

use App\Models\JobPosting;
use App\Models\JobApplication;
use LivewireUI\Modal\ModalComponent;

class ApplyToJobModal extends ModalComponent
{
    public $jobId;
    public $job;
    public $name;
    public $age;
    public $education;
    public $marital_status;
    public $military_status;
    public $residence;
    public $desired_position;
    public $whatsapp_phone;
    public $about;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:16|max:100',
            'education' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'military_status' => 'nullable|string|max:255',
            'residence' => 'nullable|string|max:255',
            'desired_position' => 'nullable|string|max:255',
            'whatsapp_phone' => 'nullable|string|max:20',
            'about' => 'nullable|string',
        ];
    }

    public function mount($job = null)
    {
        if ($job) {
            // If job is passed as ID, load it
            if (is_numeric($job)) {
                $this->job = JobPosting::findOrFail($job);
                $this->jobId = $this->job->id;
            } else {
                // If job is passed as model instance
                $this->job = $job;
                $this->jobId = $this->job->id ?? null;
            }
        } else {
            abort(404);
        }
    }

    public function apply()
    {
        $this->validate();

        JobApplication::create([
            'job_posting_id' => $this->jobId,
            'name' => $this->name,
            'age' => $this->age,
            'education' => $this->education,
            'marital_status' => $this->marital_status,
            'military_status' => $this->military_status,
            'residence' => $this->residence,
            'desired_position' => $this->desired_position,
            'whatsapp_phone' => $this->whatsapp_phone,
            'about' => $this->about,
            'status' => JobApplication::STATUS_PENDING,
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
