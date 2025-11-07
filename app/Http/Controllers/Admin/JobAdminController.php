<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobAdminController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = JobPosting::with('user');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $jobs = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('jobs.admin.index', compact('jobs', 'status'));
    }

    public function approve(JobPosting $job)
    {
        $job->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', __('general.job_approved'));
    }

    public function reject(JobPosting $job)
    {
        $job->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', __('general.job_rejected'));
    }

    public function applications(JobPosting $job)
    {
        $job->load(['applications.user', 'applications.employeeProfile']);

        return view('jobs.admin.applications', compact('job'));
    }

    public function destroy(JobPosting $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', __('general.massages.deleted'));
    }
}

