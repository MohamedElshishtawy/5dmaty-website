<?php

namespace App\Http\Controllers;

use App\Models\EmployeeProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upsert(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:16|max:100',
            'education' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'military_status' => 'nullable|string|max:255',
            'residence' => 'nullable|string|max:255',
            'desired_position' => 'nullable|string|max:255',
            'whatsapp_phone' => 'nullable|string|max:20',
            'about' => 'nullable|string',
            'is_public' => 'nullable|boolean',
        ]);

        $profile = Auth::user()->employeeProfile;

        if ($profile) {
            $profile->update($validated);
        } else {
            $validated['user_id'] = Auth::id();
            $profile = EmployeeProfile::create($validated);
        }

        return back()->with('success', __('general.profile_saved'));
    }
}
