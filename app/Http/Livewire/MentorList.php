<?php

namespace App\Http\Livewire;

use App\Models\Skill;
use App\Models\User;
use Livewire\Component;

class MentorList extends Component
{

    public $mentors;
    public $skills;
    public $skill_selected;
    public $search;

    public function mount()
    {
        $this->skills = Skill::get();
    }

    public function updated()
    {
        $this->mentors = User::where('name', 'like', '%'.$this->search.'%')->where('role', 'mentor')->where('status', 'verified')->get();
    }

    public function resetFilterSkill()
    {
        $this->mentors = User::where('role', 'mentor')->where('status', 'verified')->with('skills', 'detail')->get();
        $this->reset('skill_selected');
    }

    public function filterSkill(Skill $skill)
    {
        $this->mentors = $skill->users;
        $this->skill_selected = $skill->skill;
    }

    public function render()
    {
        return view('livewire.mentor-list');
    }
}
