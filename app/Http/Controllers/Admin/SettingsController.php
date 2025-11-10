<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Support\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(Request $request): View
    {
        $languages = Language::query()->active()->orderBy('id')->get();
        $settingsMap = Settings::allAsMap();

        return view('admin.settings.index', [
            'languages' => $languages,
            'settings' => $settingsMap,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        // Validate uploads
        $validated = $request->validate([
            // Use file+mimes to allow SVG in addition to raster formats
            'site_logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg'],
            'site_favicon' => ['nullable', 'file', 'mimes:ico,png,svg'],
            'home_hero_logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg'],

            // Per-language fields are free-form; we will sanitize per field.
            'seo' => ['array'],
            'seo.*.title' => ['nullable', 'string', 'max:120'],
            'seo.*.description' => ['nullable', 'string', 'max:300'],
            'seo.*.keywords' => ['nullable', 'string', 'max:300'],

            'hero' => ['array'],
            'hero.*.title' => ['nullable', 'string', 'max:150'],
            'hero.*.subtitle' => ['nullable', 'string', 'max:250'],
        ]);

        // Handle file uploads
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Settings::put('site.logo', $path, null, 'image');
        }
        if ($request->hasFile('site_favicon')) {
            $path = $request->file('site_favicon')->store('settings', 'public');
            Settings::put('site.favicon', $path, null, 'image');
        }
        if ($request->hasFile('home_hero_logo')) {
            $path = $request->file('home_hero_logo')->store('settings', 'public');
            Settings::put('home.hero.logo', $path, null, 'image');
        }

        // Persist per-locale SEO and Hero text
        $seo = Arr::get($validated, 'seo', []);
        foreach ($seo as $locale => $fields) {
            Settings::put('seo.home.title', Arr::get($fields, 'title'), $locale, 'string');
            Settings::put('seo.home.description', Arr::get($fields, 'description'), $locale, 'text');
            Settings::put('seo.home.keywords', Arr::get($fields, 'keywords'), $locale, 'text');
        }

        $hero = Arr::get($validated, 'hero', []);
        foreach ($hero as $locale => $fields) {
            Settings::put('home.hero.title', Arr::get($fields, 'title'), $locale, 'string');
            Settings::put('home.hero.subtitle', Arr::get($fields, 'subtitle'), $locale, 'text');
        }

        return back()->with('status', __('تم حفظ الإعدادات بنجاح'));
    }
}


