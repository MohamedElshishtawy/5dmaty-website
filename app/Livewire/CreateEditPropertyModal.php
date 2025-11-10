<?php

namespace App\Livewire;

use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class CreateEditPropertyModal extends ModalComponent
{
    use WithFileUploads;

    public Property $property;
    public $title;
    public $description;
    public $price;
    public $location;
    public $whatsapp_phone;
    public $published_at;
    public $property_type;
    public $property_status;
    public $media_files;
    public $medias = [];

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'whatsapp_phone' => 'nullable|string|max:20',
            'published_at' => 'nullable|date',
            'property_type' => 'required|in:sale,rent',
            'property_status' => 'required|in:inactive,active,sold',
            'media_files' => 'nullable|array',
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:10240',
        ];
    }

    public function mount(Property $property)
    {
        $this->property = $property;
        if ($this->property->id) {
            $this->title = $this->property->title;
            $this->description = $this->property->description;
            $this->price = $this->property->price;
            $this->location = $this->property->location;
            $this->whatsapp_phone = $this->property->whatsapp_phone;
            $this->published_at = $this->property->published_at ? $this->property->published_at->format('Y-m-d') : null;
            $this->property_type = $this->property->property_type;
            $this->property_status = $this->property->property_status ?: \App\Models\Property::STATUS_ACTIVE;
            $this->medias = $this->property->medias;
        } else {
            $this->property_status = \App\Models\Property::STATUS_ACTIVE;
        }
    }

    public function save()
    {
        $this->validate();

        // Create or update property
        if ($this->property->id) {
            // Update existing property
            $this->property->update([
                'title' => $this->title,
                'description' => $this->description,
                'property_type' => $this->property_type,
                'property_status' => $this->property_status,
                'price' => $this->price,
                'location' => $this->location,
                'whatsapp_phone' => $this->whatsapp_phone,
                'published_at' => $this->published_at,
            ]);
            $property = $this->property;
        } else {
            // Create new property
            $property = Property::create([
                'title' => $this->title,
                'description' => $this->description,
                'property_type' => $this->property_type,
                'property_status' => $this->property_status ?: \App\Models\Property::STATUS_ACTIVE,
                'price' => $this->price,
                'location' => $this->location,
                'whatsapp_phone' => $this->whatsapp_phone,
                'published_at' => $this->published_at,
            ]);
        }

        // Handle media files upload
        if ($this->media_files) {
            foreach ($this->media_files as $file) {
                $path = $file->store('properties', 'public');
                $property->medias()->create(['url' => $path]);
            }
        }

        // Show success message
        session()->flash('message', $this->property->id ? __('general.massages.updated') : __('general.massages.created'));

        // Close modal and refresh parent component
        $this->dispatch('closeModal');
        $this->dispatch('propertyUpdated');
    }

    public function deleteMedia($id)
    {
        $media = $this->property->medias()->find($id);
        if ($media) {
            // Delete file from storage
            if (Storage::disk('public')->exists($media->url)) {
                Storage::disk('public')->delete($media->url);
            }

            // Delete record from database
            $media->delete();

            // Refresh medias collection
            $this->medias = $this->property->fresh()->medias;

            // Show success message
            session()->flash('message', __('general.massages.deleted'));
        }
    }

    public function render()
    {
        return view('livewire.create-edit-property-modal');
    }
}
