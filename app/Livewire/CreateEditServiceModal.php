<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class CreateEditServiceModal extends ModalComponent
{
    use WithFileUploads;

    public Service $service;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $is_active = true;

    public $icon_image_file;
    public $media_files;
    public $serviceId;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean',
            'icon_image_file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'media_files' => 'nullable|array',
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:10240',
        ];
    }

    public function mount($service = null, $category_id = null)
    {
        if ($service) {
            if (is_numeric($service)) {
                $this->service = Service::findOrFail($service);
                $this->serviceId = $this->service->id;
            } else {
                $this->service = $service;
                $this->serviceId = $this->service->id ?? null;
            }
        } else {
            $this->service = new Service();
        }

        if ($this->service->id) {
            $this->name = $this->service->name;
            $this->description = $this->service->description;
            $this->price = $this->service->price;
            $this->category_id = $this->service->category_id;
            $this->is_active = $this->service->is_active;
        } else {
            if ($category_id) {
                $this->category_id = $category_id;
            }
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'is_active' => (bool)$this->is_active,
        ];

        if ($this->service->id) {
            $this->service->update($data);
            $service = $this->service;
        } else {
            $service = Service::create($data);
        }

        if ($this->icon_image_file) {
            $path = $this->icon_image_file->store('services/icons', 'public');
            $service->icon_image = $path;
            $service->save();
        }

        if ($this->media_files) {
            foreach ($this->media_files as $file) {
                $path = $file->store('services/gallery', 'public');
                $service->medias()->create(['url' => $path]);
            }
        }

        session()->flash('message', $this->service->id ? __('general.massages.updated') : __('general.massages.created'));

        $this->dispatch('serviceUpdated');
        $this->dispatch('closeModal');
    }

    public function deleteIcon()
    {
        if ($this->service->icon_image && Storage::disk('public')->exists($this->service->icon_image)) {
            Storage::disk('public')->delete($this->service->icon_image);
            $this->service->icon_image = null;
            $this->service->save();
        }
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();
        return view('livewire.create-edit-service-modal', [
            'categories' => $categories,
        ]);
    }
}


