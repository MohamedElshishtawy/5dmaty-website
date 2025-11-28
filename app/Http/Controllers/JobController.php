<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\JobApplication;
use App\Models\EmployeeProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // Public index - shows tabs with jobs or employees
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'jobs'); // Default to jobs tab

        if ($tab === 'employees') {
            // Show public employee profiles
            $employees = EmployeeProfile::public()
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            $jobs = collect(); // Empty collection for consistency

            return view('jobs.public.index', compact('tab', 'employees', 'jobs'));
        }

        // Show approved and active jobs
        $jobs = JobPosting::approvedActive()
            ->with('user')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $employees = collect(); // Empty collection for consistency

        return view('jobs.public.index', compact('tab', 'jobs', 'employees'));
    }

    // Show single job
    public function show(JobPosting $job)
    {
        // Check if user can view this job
        $canView = false;
        
        // Public can view if approved and active
        if ($job->status === 'approved' && $job->is_active) {
            $canView = true;
        }
        
        // Owner or admin can always view
        if (Auth::check() && (Auth::id() === $job->user_id || Auth::user()->hasRole(['superadmin', 'admin']))) {
            $canView = true;
        }
        
        if (!$canView) {
            abort(404);
        }

        $job->load('user', 'applications');

        return view('jobs.public.show', compact('job'));
    }

    // Store new job (auth + role required)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'shop_name' => 'nullable|string|max:255',
            'shop_address' => 'nullable|string|max:255',
            'whatsapp_phone' => 'nullable|string|max:20',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['published_at'] = now();

        $job = JobPosting::create($validated);

        return redirect()->route('jobs.show', $job->slug)
            ->with('success', __('general.job_created_pending'));
    }

    // Toggle active status (owner or admin)
    public function toggleActive(JobPosting $job)
    {
        // Check authorization
        if (Auth::id() !== $job->user_id && !Auth::user()->hasRole(['superadmin', 'admin'])) {
            abort(403);
        }

        $job->update(['is_active' => !$job->is_active]);

        return back()->with('success', $job->is_active ? __('general.job_opened') : __('general.job_closed'));
    }

    // Update application status (owner or admin)
    public function updateApplicationStatus(Request $request, JobPosting $job, JobApplication $application)
    {
        // Check authorization - must be job owner or admin
        if (Auth::id() !== $job->user_id && !Auth::user()->hasRole(['superadmin', 'admin'])) {
            abort(403);
        }

        // Verify application belongs to this job
        if ($application->job_posting_id !== $job->id) {
            abort(404);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $application->update(['status' => $validated['status']]);

        $message = $validated['status'] === 'accepted' 
            ? __('general.application_accepted') 
            : __('general.application_rejected');

        return back()->with('success', $message);
    }
}
