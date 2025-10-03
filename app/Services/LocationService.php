<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class LocationService
{
    /**
     * Return available countries. For now, only Egypt is enabled.
     *
     * @return array<int, array{code:string,name:string}>
     */
    public function getCountries(): array
    {
        // In future, this could call a provider API to list supported countries
        return [
            ['code' => 'EG', 'name' => 'Egypt'],
        ];
    }

    /**
     * Return governorates for a given ISO country code.
     *
     * @param string $countryCode
     * @return array<int, string>
     */
    public function getGovernorates(string $countryCode): array
    {
        $countryCode = strtoupper($countryCode);

        return Cache::remember("locations:{$countryCode}:governorates", now()->addHours(12), function () use ($countryCode) {
            // Try external provider first if configured
            $governorates = $this->fetchGovernoratesFromApi($countryCode);
            if (!empty($governorates)) {
                sort($governorates, SORT_NATURAL | SORT_FLAG_CASE);
                return $governorates;
            }

            // Fallback to local dataset
            $data = $this->readLocalDataset($countryCode);
            $items = collect($data['governorates'] ?? [])->pluck('name')->all();
            sort($items, SORT_NATURAL | SORT_FLAG_CASE);
            return $items;
        });
    }

    /**
     * Return cities for a given country and governorate name.
     *
     * @param string $countryCode
     * @param string $governorate
     * @return array<int, string>
     */
    public function getCities(string $countryCode, string $governorate): array
    {
        $countryCode = strtoupper($countryCode);
        $governorate = trim($governorate);

        $cacheKey = "locations:{$countryCode}:cities:" . md5($governorate);

        return Cache::remember($cacheKey, now()->addHours(12), function () use ($countryCode, $governorate) {
            // Try external provider
            $cities = $this->fetchCitiesFromApi($countryCode, $governorate);
            if (!empty($cities)) {
                sort($cities, SORT_NATURAL | SORT_FLAG_CASE);
                return $cities;
            }

            // Fallback to local dataset
            $data = $this->readLocalDataset($countryCode);
            $gov = collect($data['governorates'] ?? [])->firstWhere('name', $governorate);
            $items = array_values(Arr::wrap($gov['cities'] ?? []));
            sort($items, SORT_NATURAL | SORT_FLAG_CASE);
            return $items;
        });
    }

    /**
     * Attempt to fetch governorates from an external API.
     * Uses countriesnow.space as a free provider if enabled.
     *
     * @param string $countryCode
     * @return array<int,string>
     */
    protected function fetchGovernoratesFromApi(string $countryCode): array
    {
        if (!filter_var(config('services.locations.enable_remote', true), FILTER_VALIDATE_BOOLEAN)) {
            return [];
        }

        // Map ISO code to common name expected by the provider
        $countryName = match (strtoupper($countryCode)) {
            'EG' => 'Egypt',
            default => null,
        };

        if ($countryName === null) {
            return [];
        }

        try {
            $resp = Http::timeout(8)->retry(2, 250)->post('https://countriesnow.space/api/v0.1/countries/states', [
                'country' => $countryName,
            ]);
            if ($resp->ok()) {
                $states = data_get($resp->json(), 'data.states', []);
                $names = collect($states)->pluck('name')->filter()->values()->all();
                return array_map(fn ($n) => (string) $n, $names);
            }
        } catch (\Throwable $e) {
            // fall back silently
        }

        return [];
    }

    /**
     * Attempt to fetch cities for a given governorate from an external API.
     *
     * @param string $countryCode
     * @param string $governorate
     * @return array<int,string>
     */
    protected function fetchCitiesFromApi(string $countryCode, string $governorate): array
    {
        if (!filter_var(config('services.locations.enable_remote', true), FILTER_VALIDATE_BOOLEAN)) {
            return [];
        }

        $countryName = match (strtoupper($countryCode)) {
            'EG' => 'Egypt',
            default => null,
        };

        if ($countryName === null || $governorate === '') {
            return [];
        }

        try {
            $resp = Http::timeout(8)->retry(2, 250)->post('https://countriesnow.space/api/v0.1/countries/state/cities', [
                'country' => $countryName,
                'state' => $governorate,
            ]);
            if ($resp->ok()) {
                $cities = data_get($resp->json(), 'data', []);
                $names = collect($cities)->filter()->values()->all();
                return array_map(fn ($n) => (string) $n, $names);
            }
        } catch (\Throwable $e) {
            // fall back silently
        }

        return [];
    }

    /**
     * Read local dataset for a country code.
     *
     * @param string $countryCode
     * @return array<string,mixed>
     */
    protected function readLocalDataset(string $countryCode): array
    {
        $path = "locations/" . strtolower($countryCode) . ".json";
        if (!Storage::exists($path)) {
            return [];
        }
        $json = Storage::get($path);
        return json_decode($json, true) ?: [];
    }
}



