<?php

namespace App\Livewire;

use App\Models\JobPosting;
use Livewire\Component;

class ManageJobsLivewire extends Component
{
    public $status = 'all';
    protected $listeners = ['jobUpdated' => '$refresh'];

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

    public function render()
    {
        $query = JobPosting::with('user');

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        $jobs = $query->orderBy('created_at', 'desc')->get();

        return view('livewire.manage-jobs-livewire', ['jobs' => $jobs]);
    }
}
