<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class ManagePropertiesLivewire extends Component
{
    protected $listeners = ['propertyUpdated' => '$refresh'];

    public function delete($id)
    {
        $property = Property::find($id);
        if ($property) {
            $property->delete();
            session()->flash('message', __('general.massages.deleted'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function render()
    {
        $properties = Property::orderBy('created_at', 'desc')->get();
        return view('livewire.manage-properties-livewire', ['properties' => $properties]);
    }
}
