<?php

namespace App\Livewire;

use App\Models\Category;
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

    public function render()
    {
        $categories = Category::all();
        return view('livewire.manage-categories-livewire', ['categories' => $categories]);
    }
}
