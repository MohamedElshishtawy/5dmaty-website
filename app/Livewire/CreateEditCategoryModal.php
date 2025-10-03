<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateEditCategoryModal extends ModalComponent
{
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
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
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

    public function  save()
    {
        $this->validate();

        $category = Category::CreateOrUpdate(
            ['name' => $this->name],
            ['description' => $this->description],
        );

        if ($this->media_files) {
            foreach ($this->media_files as $file) {
                $path = $file->store('categories', 'public');
                $category->medias()->create(['file_path' => $path]);
            }
        }

    }

    public function deleteMedia($id)
    {
        $media = $this->category->medias()->find($id);
        if ($media) {
            Storage::disk('public')->delete($media->file_path);
            $media->delete();
            $this->medias = $this->category->medias;
        }
    }


    public function render()
    {
        return view('livewire.create-edit-category-modal');
    }
}
