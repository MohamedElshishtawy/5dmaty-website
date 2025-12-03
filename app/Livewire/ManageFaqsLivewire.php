<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class ManageFaqsLivewire extends Component
{
    protected $listeners = ['faqUpdated' => '$refresh'];

    public function delete($id): void
    {
        $faq = Faq::find($id);
        if ($faq) {
            $faq->delete();
            session()->flash('message', __('general.massages.deleted'));
        } else {
            session()->flash('error', __('general.massages.not_found'));
        }
    }

    public function toggleActive($id): void
    {
        $faq = Faq::find($id);
        if ($faq) {
            $faq->update(['is_active' => !$faq->is_active]);
            session()->flash('message', $faq->is_active ? __('general.active') : __('general.inactive'));
        }
    }

    public function render()
    {
        $faqs = Faq::query()->get();
        return view('livewire.manage-faqs-livewire', ['faqs' => $faqs]);
    }
}




















