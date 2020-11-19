<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{

    use WithFileUploads;

    public $user;
    public $photo;
    public $photo_validated;
    public $photo_name;
    public $description;

    public function render()
    {

        return view('livewire.update-profile');
    }

    public function mount()
    {
        if ($this->user->detail) {
            $this->description = $this->user->detail->description;
            // $this->photo = $this->user->detail->photo;
        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'required|image|max:4096',
        ]);
        $this->photo_validated = $this->photo;
        $this->photo_name = $this->photo->getClientOriginalName();
    }

    public function updatedDescription()
    {
        $this->validate([
            'description' => 'required|min:10'
        ]);
    }

    public function save()
    {

        if ($this->user->detail) {
            $detail = UserDetail::find($this->user->detail->id);
            if ($this->photo != null) {
                $this->validate([
                    'photo' => 'required|image|max:4096',
                    'description' => 'required|min:10'
                ]);
                $detail->photo = $this->photo->store('photo');
                Storage::delete($this->user->detail->photo);
            } else {
                $this->validate([
                    'description' => 'required|min:10'
                ]);
            }
            $detail->description = $this->description;
            $detail->save();
            session()->flash('status', 'Profile successfully updated.');
            return redirect()->route('dashboard.profile');
        } else {
            if ($this->photo != null) {
                $this->validate([
                    'photo' => 'required|image|max:4096',
                    'description' => 'required|min:10'
                ]);
                UserDetail::create([
                    'user_id' => $this->user->id,
                    'photo' => $this->photo->store('photo'),
                    'description' => $this->description
                ]);
            } else {
                $this->validate([
                    'description' => 'required|min:10'
                ]);
                UserDetail::create([
                    'user_id' => $this->user->id,
                    'description' => $this->description
                ]);
            }
            session()->flash('status', 'Profile successfully updated.');
            return redirect()->route('dashboard.profile');
        }
    }
}
