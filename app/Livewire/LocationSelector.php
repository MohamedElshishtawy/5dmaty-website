<?php

namespace App\Livewire;

use App\Services\LocationService;
use Livewire\Attributes\On;
use Livewire\Component;

class LocationSelector extends Component
{
    public array $countries = [];
    public string $country = 'EG';

    public array $governorates = [];
    public ?string $government = null;

    public array $cities = [];
    public ?string $city = null;

    public function mount(LocationService $locations): void
    {
        $this->countries = $locations->getCountries();
        $this->governorates = $locations->getGovernorates($this->country);
    }

    public function updatedCountry(LocationService $locations): void
    {
        $this->government = null;
        $this->city = null;
        $this->governorates = $locations->getGovernorates($this->country);
        $this->cities = [];
    }

    public function updatedGovernment(LocationService $locations): void
    {
        $this->city = null;
        if ($this->government) {
            $this->cities = $locations->getCities($this->country, $this->government);
        } else {
            $this->cities = [];
        }
    }

    public function render()
    {
        return view('livewire.location-selector');
    }
}



