<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class CreateEditCategoryModal extends ModalComponent
{
    use WithFileUploads;
    public Category $category;
    public $name;
    public $description;
    public $media_files;
    public $medias = [];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'media_files' => 'nullable|array',
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm,ogg,avi,mov|max:10240',
        ];
    }

    public function mount(Category $category)
    {
        $this->category = $category;
        if ($this->category->id) {
            $this->name = $this->category->name;
            $this->description = $this->category->description;
            $this->medias = $this->category->medias;
        }
    }

    public function save()
    {
        $this->validate();

        // Create or update category
        if ($this->category->id) {
            // Update existing category
            $this->category->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            $category = $this->category;
        } else {
            // Create new category
            $category = Category::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);
        }

        // Handle media files upload
        if ($this->media_files) {
            foreach ($this->media_files as $file) {
                $path = $file->store('categories', 'public');
                $category->medias()->create(['url' => $path]);
            }
        }

        // Show success message
        session()->flash('message', $this->category->id ? __('general.massages.updated') : __('general.massages.created'));

        // Close modal and refresh parent component
        $this->dispatch('closeModal');
        $this->dispatch('categoryUpdated');
    }

    public function deleteMedia($id)
    {
        $media = $this->category->medias()->find($id);
        if ($media) {
            // Delete file from storage
            if (Storage::disk('public')->exists($media->url)) {
                Storage::disk('public')->delete($media->url);
            }

            // Delete record from database
            $media->delete();

            // Refresh medias collection
            $this->medias = $this->category->fresh()->medias;

            // Show success message
            session()->flash('message', __('general.massages.deleted'));
        }
    }


    public function render()
    {
        return view('livewire.create-edit-category-modal');
    }
}
