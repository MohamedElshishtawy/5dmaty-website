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
    public function publicIndex(Request $request)
    {
        $query = Property::where('is_accepted', true)
            ->where('property_status', 'active')
            ->publiclyVisible()
            ->with('medias')
            ->orderBy('published_at', 'desc');

        $propertyType = $request->query('property_type');
        if (in_array($propertyType, [Property::TYPE_SALE, Property::TYPE_RENT], true)) {
            $query->where('property_type', $propertyType);
        }

        // Only allow filtering to active or sold on public
        $propertyStatus = $request->query('property_status');
        if (in_array($propertyStatus, [Property::STATUS_ACTIVE, Property::STATUS_SOLD], true)) {
            $query->where('property_status', $propertyStatus);
        }

        $properties = $query->paginate(12)->appends($request->query());

        return view('property.public.index', [
            'properties' => $properties,
            'filters' => [
                'property_type' => $propertyType,
                'property_status' => $propertyStatus,
            ],
        ]);
    }

    // Public show - shows single property details
    public function show(Property $property)
    {
        // Only show published and publicly visible properties
        if (
            !$property->published_at ||
            $property->published_at > now() ||
            !$property->isPubliclyVisible()
        ) {
            abort(404);
        }

        return view('property.public.show', compact('property'));
    }
}
