<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Service;
use Livewire\Component;

class ManageCategoriesLivewire extends Component
{
    protected $listeners = ['categoryUpdated' => '$refresh'];
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            session()->flash('message', __('general.massages.deleted'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->delete();
            session()->flash('message', __('general.massages.deleted'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function render()
    {
        $categories = Category::with('services')->get();
        return view('livewire.manage-categories-livewire', ['categories' => $categories]);
    }
}
