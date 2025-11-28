<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\EmployeeProfile;
use App\Models\Faq;
use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\Property;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'users' => [
                'total' => User::count(),
            ],
            'properties' => [
                'total' => Property::count(),
                'active' => Property::where('property_status', Property::STATUS_ACTIVE)->count(),
                'soldOrRented' => Property::where('property_status', Property::STATUS_SOLD)->count(),
                'pendingApproval' => Property::where('is_accepted', false)->count(),
            ],
            'categories' => [
                'total' => Category::count(),
            ],
            'services' => [
                'total' => Service::count(),
                'active' => Service::where('is_active', true)->count(),
            ],
            'jobs' => [
                'total' => JobPosting::count(),
                'pending' => JobPosting::where('status', 'pending')->count(),
                'approved' => JobPosting::where('status', 'approved')->count(),
                'rejected' => JobPosting::where('status', 'rejected')->count(),
            ],
            'applications' => [
                'total' => JobApplication::count(),
            ],
            'employees' => [
                'total' => EmployeeProfile::count(),
                'public' => EmployeeProfile::where('is_public', true)->count(),
            ],
            'faqs' => [
                'total' => Faq::count(),
                'active' => Faq::where('is_active', true)->count(),
            ],
        ];

        $statSections = [
            [
                'title' => __('general.users-management'),
                'items' => [
                    ['label' => __('general.dashboard_users_total'), 'value' => $stats['users']['total']],
                ],
            ],
            [
                'title' => __('general.real-state-management'),
                'items' => [
                    ['label' => __('general.dashboard_properties_total'), 'value' => $stats['properties']['total']],
                    ['label' => __('general.dashboard_properties_active'), 'value' => $stats['properties']['active']],
                    ['label' => __('general.dashboard_properties_sold'), 'value' => $stats['properties']['soldOrRented']],
                    ['label' => __('general.dashboard_properties_pending'), 'value' => $stats['properties']['pendingApproval']],
                ],
            ],
            [
                'title' => __('general.categories'),
                'items' => [
                    ['label' => __('general.dashboard_categories_total'), 'value' => $stats['categories']['total']],
                ],
            ],
            [
                'title' => __('general.services'),
                'items' => [
                    ['label' => __('general.dashboard_services_total'), 'value' => $stats['services']['total']],
                    ['label' => __('general.dashboard_services_active'), 'value' => $stats['services']['active']],
                ],
            ],
            [
                'title' => __('general.employment-management'),
                'items' => [
                    ['label' => __('general.dashboard_jobs_total'), 'value' => $stats['jobs']['total']],
                    ['label' => __('general.dashboard_jobs_pending'), 'value' => $stats['jobs']['pending']],
                    ['label' => __('general.dashboard_jobs_approved'), 'value' => $stats['jobs']['approved']],
                    ['label' => __('general.dashboard_jobs_rejected'), 'value' => $stats['jobs']['rejected']],
                    ['label' => __('general.dashboard_applications_total'), 'value' => $stats['applications']['total']],
                ],
            ],
            [
                'title' => __('general.employee_management'),
                'items' => [
                    ['label' => __('general.dashboard_employees_total'), 'value' => $stats['employees']['total']],
                    ['label' => __('general.dashboard_employees_public'), 'value' => $stats['employees']['public']],
                ],
            ],
            [
                'title' => __('general.faq_management'),
                'items' => [
                    ['label' => __('general.dashboard_faqs_total'), 'value' => $stats['faqs']['total']],
                    ['label' => __('general.dashboard_faqs_active'), 'value' => $stats['faqs']['active']],
                ],
            ],
        ];

        return view('admin.dashboard', [
            'stats' => $stats,
            'statSections' => $statSections,
        ]);
    }
}

