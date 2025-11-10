<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Settings
{
    protected const CACHE_KEY = 'settings.v1.all';

    /**
     * Get a setting value with locale fallback (current -> null -> default).
     */
    public static function get(string $key, mixed $default = null, ?string $locale = null): mixed
    {
        $localeToUse = $locale ?: app()->getLocale();
        $map = self::allAsMap();

        // Try locale-specific
        $localized = Arr::get($map, "{$localeToUse}.{$key}");
        if (!is_null($localized)) {
            return $localized;
        }
        // Fallback to unlocalized
        $unlocalized = Arr::get($map, "_.{$key}");
        if (!is_null($unlocalized)) {
            return $unlocalized;
        }
        return $default;
    }

    /**
     * Convenience for image URL building from storage path.
     */
    public static function imageUrl(string $key, ?string $defaultUrl = null, ?string $locale = null): ?string
    {
        $value = self::get($key, null, $locale);
        if (!$value) {
            return $defaultUrl;
        }
        // If already absolute URL, return as is
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '/')) {
            return $value;
        }
        return asset('storage/' . ltrim($value, '/'));
    }

    /**
     * Put a setting value and clear cache. Controller layer should validate types and storage.
     */
    public static function put(string $key, mixed $value, ?string $locale = null, string $type = 'string'): void
    {
        Setting::updateOrCreate(
            ['key' => $key, 'locale' => $locale],
            ['value' => $value, 'type' => $type]
        );
        self::clearCache();
    }

    /**
     * Return all settings as a [locale => [key => value]] map.
     * Use '_' for unlocalized.
     */
    public static function allAsMap(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            $map = [];
            /** @var \Illuminate\Database\Eloquent\Collection<int, Setting> $settings */
            $settings = Setting::query()->get(['key', 'locale', 'value']);
            foreach ($settings as $setting) {
                $bucket = $setting->locale ?: '_';
                if (!array_key_exists($bucket, $map)) {
                    $map[$bucket] = [];
                }
                $map[$bucket][$setting->key] = $setting->value;
            }
            return $map;
        });
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}


