<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageAdminController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:10', 'regex:/^[a-zA-Z_-]+$/', 'unique:languages,code'],
            'name' => ['required', 'string', 'max:100'],
            'is_rtl' => ['nullable', 'boolean'],
        ]);

        Language::create([
            'code' => strtolower($data['code']),
            'name' => $data['name'],
            'is_active' => true,
            'is_rtl' => (bool)($data['is_rtl'] ?? false),
        ]);

        return back()->with('status', __('تمت إضافة اللغة بنجاح'));
    }

    public function toggle(Language $language): RedirectResponse
    {
        $language->is_active = !$language->is_active;
        $language->save();
        return back()->with('status', __('تم تحديث حالة اللغة'));
    }
}


