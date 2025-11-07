<?php

namespace App\Livewire;

use App\Models\JobPosting;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateEditJobModal extends ModalComponent
{
    public $jobId;
    public $job;
    public $title;
    public $description;
    public $shop_name;
    public $shop_address;
    public $whatsapp_phone;

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'shop_name' => 'nullable|string|max:255',
            'shop_address' => 'nullable|string|max:255',
            'whatsapp_phone' => 'nullable|string|max:20',
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
            
            if ($this->job && $this->job->id) {
                $this->title = $this->job->title;
                $this->description = $this->job->description;
                $this->shop_name = $this->job->shop_name;
                $this->shop_address = $this->job->shop_address;
                $this->whatsapp_phone = $this->job->whatsapp_phone;
            }
        } else {
            // Creating new job
            $this->job = new JobPosting();
            $this->jobId = null;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->job->id) {
            // Update existing job
            $this->job->update([
                'title' => $this->title,
                'description' => $this->description,
                'shop_name' => $this->shop_name,
                'shop_address' => $this->shop_address,
                'whatsapp_phone' => $this->whatsapp_phone,
            ]);
            $message = __('general.massages.updated');
        } else {
            // Create new job
            JobPosting::create([
                'user_id' => Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
                'shop_name' => $this->shop_name,
                'shop_address' => $this->shop_address,
                'whatsapp_phone' => $this->whatsapp_phone,
                'status' => 'pending',
                'published_at' => now(),
            ]);
            $message = __('general.job_created_pending');
        }

        session()->flash('message', $message);
        $this->dispatch('closeModal');
        $this->dispatch('jobUpdated');
    }

    public function render()
    {
        return view('livewire.create-edit-job-modal');
    }
}
