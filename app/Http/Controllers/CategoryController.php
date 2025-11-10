<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // category crud operations

    public function index()
    {
        return view('category.index');
    }

    // Public: show category with its services
    public function show(Category $category)
    {
        $category->load(['medias', 'services' => function ($q) {
            $q->where('is_active', true)->with('medias');
        }]);

        return view('category.public.show', compact('category'));
    }





}
