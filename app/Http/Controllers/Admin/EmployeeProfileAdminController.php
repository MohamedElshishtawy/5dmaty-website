<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeProfile;
use Illuminate\Http\Request;

class EmployeeProfileAdminController extends Controller
{
    public function index(Request $request)
    {
        $visibility = $request->get('visibility', 'all');
        $query = EmployeeProfile::with('user');

        if ($visibility === 'public') {
            $query->where('is_public', true);
        } elseif ($visibility === 'private') {
            $query->where('is_public', false);
        }

        $employees = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('employees.admin.index', compact('employees', 'visibility'));
    }

    public function show(EmployeeProfile $employee)
    {
        $employee->load('user', 'jobApplications.jobPosting');
        return view('employees.admin.show', compact('employee'));
    }

    public function destroy(EmployeeProfile $employee)
    {
        $employee->delete();
        return back()->with('success', __('general.massages.deleted'));
    }

    public function togglePublic(EmployeeProfile $employee)
    {
        $employee->update(['is_public' => !$employee->is_public]);
        return back()->with('success', __('general.massages.updated'));
    }
}

