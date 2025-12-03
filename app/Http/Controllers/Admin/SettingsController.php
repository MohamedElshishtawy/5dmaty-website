<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Setting;
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
        
        // Get all settings and organize them by locale
        $settings = Setting::all();
        $settingsMap = [];
        
        foreach ($settings as $setting) {
            $locale = $setting->locale ?: '_';
            if (!isset($settingsMap[$locale])) {
                $settingsMap[$locale] = [];
            }
            $settingsMap[$locale][$setting->key] = $setting->value;
        }

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
            'seo.*.description' => ['nullable', 'string', 'max:65000'],
            'seo.*.keywords' => ['nullable', 'string', 'max:65000'],

            'hero' => ['array'],
            'hero.*.title' => ['nullable', 'string', 'max:150'],
            'hero.*.subtitle' => ['nullable', 'string', 'max:250'],
        ]);

        // Handle file uploads
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(
                ['key' => 'site.logo', 'locale' => null],
                ['value' => $path, 'type' => 'image']
            );
        }
        if ($request->hasFile('site_favicon')) {
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::updateOrCreate(
                ['key' => 'site.favicon', 'locale' => null],
                ['value' => $path, 'type' => 'image']
            );
        }
        if ($request->hasFile('home_hero_logo')) {
            $path = $request->file('home_hero_logo')->store('settings', 'public');
            Setting::updateOrCreate(
                ['key' => 'home.hero.logo', 'locale' => null],
                ['value' => $path, 'type' => 'image']
            );
        }

        // Persist per-locale SEO and Hero text
        $seo = Arr::get($validated, 'seo', []);
        foreach ($seo as $locale => $fields) {
            Setting::updateOrCreate(
                ['key' => 'seo.home.title', 'locale' => $locale],
                ['value' => Arr::get($fields, 'title'), 'type' => 'string']
            );
            Setting::updateOrCreate(
                ['key' => 'seo.home.description', 'locale' => $locale],
                ['value' => Arr::get($fields, 'description'), 'type' => 'text']
            );
            Setting::updateOrCreate(
                ['key' => 'seo.home.keywords', 'locale' => $locale],
                ['value' => Arr::get($fields, 'keywords'), 'type' => 'text']
            );
        }

        $hero = Arr::get($validated, 'hero', []);
        foreach ($hero as $locale => $fields) {
            Setting::updateOrCreate(
                ['key' => 'home.hero.title', 'locale' => $locale],
                ['value' => Arr::get($fields, 'title'), 'type' => 'string']
            );
            Setting::updateOrCreate(
                ['key' => 'home.hero.subtitle', 'locale' => $locale],
                ['value' => Arr::get($fields, 'subtitle'), 'type' => 'text']
            );
        }

        return back()->with('status', __('تم حفظ الإعدادات بنجاح'));
    }
}


