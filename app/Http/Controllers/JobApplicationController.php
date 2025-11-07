<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, JobPosting $job)
    {
        // Check if user has employee profile
        if (!Auth::user()->employeeProfile) {
            return redirect()->back()
                ->with('error', __('general.employee_profile_required'))
                ->with('show_profile_modal', true);
        }

        // Check if already applied
        $existing = JobApplication::where('job_posting_id', $job->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return back()->with('info', __('general.already_applied'));
        }

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'whatsapp_phone' => 'nullable|string|max:20',
        ]);

        JobApplication::create([
            'job_posting_id' => $job->id,
            'user_id' => Auth::id(),
            'employee_profile_id' => Auth::user()->employeeProfile->id,
            'notes' => $validated['notes'] ?? null,
            'whatsapp_phone' => $validated['whatsapp_phone'] ?? Auth::user()->employeeProfile->whatsapp_phone,
        ]);

        return back()->with('success', __('general.apply_success'));
    }
}
