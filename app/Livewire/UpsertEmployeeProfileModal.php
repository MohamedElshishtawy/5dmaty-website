<?php

namespace App\Livewire;

use App\Models\EmployeeProfile;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class UpsertEmployeeProfileModal extends ModalComponent
{
    public $name;
    public $age;
    public $education;
    public $marital_status;
    public $military_status;
    public $residence;
    public $desired_position;
    public $whatsapp_phone;
    public $about;
    public $is_public = false;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:9|max:100',
            'education' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'military_status' => 'required|string|max:255',
            'residence' => 'required|string|max:255',
            'desired_position' => 'required|string|max:255',
            'whatsapp_phone' => 'required|string|max:20',
            'about' => 'required|string',
        ];
    }

    public function mount()
    {
        $profile = Auth::user()->employeeProfile;
        
        if ($profile) {
            $this->name = $profile->name;
            $this->age = $profile->age;
            $this->education = $profile->education;
            $this->marital_status = $profile->marital_status;
            $this->military_status = $profile->military_status;
            $this->residence = $profile->residence;
            $this->desired_position = $profile->desired_position;
            $this->whatsapp_phone = $profile->whatsapp_phone;
            $this->about = $profile->about;
        } else {
            // Pre-fill name from user
            $this->name = Auth::user()->name;
        }
    }

    public function save()
    {
        $this->validate();

        $profile = Auth::user()->employeeProfile;

        $data = [
            'name' => $this->name,
            'age' => $this->age,
            'education' => $this->education,
            'marital_status' => $this->marital_status,
            'military_status' => $this->military_status,
            'residence' => $this->residence,
            'desired_position' => $this->desired_position,
            'whatsapp_phone' => $this->whatsapp_phone,
            'about' => $this->about,
        ];

        if ($profile) {
            $profile->update($data);
        } else {
            $data['user_id'] = Auth::id();
            EmployeeProfile::create($data);
        }

        session()->flash('message', __('general.profile_saved'));
        $this->dispatch('closeModal');
        $this->dispatch('profileUpdated');
    }

    public function render()
    {
        return view('livewire.upsert-employee-profile-modal');
    }
}
