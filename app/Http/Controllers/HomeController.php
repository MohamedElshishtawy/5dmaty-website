<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Models\JobPosting;
use App\Models\Service;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        
        // Get latest 5 published properties
        $properties = Property::whereNotNull('published_at')
            ->where('is_accepted', true)
            ->where('property_status', 'active')
            ->orderBy('published_at', 'desc')
            ->with('medias')
            ->take(5)
            ->get();
        
        // Get latest 5 approved and active jobs
        $jobs = JobPosting::approvedActive()
            ->orderBy('published_at', 'desc')
            ->with('user')
            ->take(5)
            ->get();
        
        // Get all active services for slider
        $services = Service::with('category')
            ->where('is_active', true)
            ->orderByDesc('id')
            ->get();
        
        // FAQs: active and ordered
        $faqs = Faq::active()->get();
        
        return view('home', compact('categories', 'properties', 'jobs', 'services', 'faqs'));
    }
}
