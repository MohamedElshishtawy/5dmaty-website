<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // Admin index - shows all properties with management options
    public function index()
    {
        return view('property.index');
    }

    // Public index - shows published properties
    public function publicIndex()
    {
        $properties = Property::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->with('medias')
            ->paginate(12);

        return view('property.public.index', compact('properties'));
    }

    // Public show - shows single property details
    public function show(Property $property)
    {
        // Only show published properties
        if (!$property->published_at || $property->published_at > now()) {
            abort(404);
        }

        return view('property.public.show', compact('property'));
    }
}
