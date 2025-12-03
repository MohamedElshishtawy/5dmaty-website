<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Service;
use Livewire\Component;

class ManageServicesLivewire extends Component
{
    public $selectedCategoryId = '';

    protected $listeners = ['serviceUpdated' => '$refresh'];

    public function delete($id)
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
        $categories = Category::orderBy('name')->get();
        $query = Service::with('category')->orderByDesc('id');

        if (!empty($this->selectedCategoryId)) {
            $query->where('category_id', $this->selectedCategoryId);
        }

        $services = $query->get();

        return view('livewire.manage-services-livewire', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }
}


















