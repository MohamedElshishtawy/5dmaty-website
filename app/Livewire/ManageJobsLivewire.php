<?php

namespace App\Livewire;

use App\Models\JobPosting;
use App\Models\JobApplication;
use Livewire\Component;

class ManageJobsLivewire extends Component
{
    public $status = 'all';
    protected $listeners = ['jobUpdated' => '$refresh', 'applicationUpdated' => '$refresh'];

    public function mount()
    {
        $this->status = request()->get('status', 'all');
    }

    public function delete($id)
    {
        $job = JobPosting::find($id);
        if ($job) {
            $job->delete();
            session()->flash('message', __('general.massages.deleted'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function approve($id)
    {
        $job = JobPosting::find($id);
        if ($job) {
            $job->update([
                'status' => 'approved',
                'approved_at' => now(),
            ]);
            session()->flash('message', __('general.job_approved'));
        }
    }

    public function reject($id)
    {
        $job = JobPosting::find($id);
        if ($job) {
            $job->update([
                'status' => 'rejected',
            ]);
            session()->flash('message', __('general.job_rejected'));
        }
    }

    public function toggleActive($id)
    {
        $job = JobPosting::find($id);
        if ($job) {
            $job->update(['is_active' => !$job->is_active]);
            session()->flash('message', $job->is_active ? __('general.job_opened') : __('general.job_closed'));
        }
    }

    public function deleteApplication($id)
    {
        $application = JobApplication::find($id);
        if ($application) {
            $application->delete();
            session()->flash('message', __('general.massages.deleted'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function activateApplication($id)
    {
        $application = JobApplication::find($id);
        if ($application) {
            $application->update(['is_active' => true]);
            session()->flash('message', __('general.application_activated'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function deactivateApplication($id)
    {
        $application = JobApplication::find($id);
        if ($application) {
            $application->update(['is_active' => false]);
            session()->flash('message', __('general.application_deactivated'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function render()
    {
        $query = JobPosting::with('user', 'applications');

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        $jobs = $query->orderBy('created_at', 'desc')->get();

        return view('livewire.manage-jobs-livewire', ['jobs' => $jobs]);
    }
}
