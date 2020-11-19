<?php

namespace App\Http\Livewire;

use App\Models\Schedule;
use Carbon\Carbon;
use Livewire\Component;

class RequestForm extends Component
{

    public $user;
    public $dates;
    public $date_select;
    public $min;
    public $max;
    public $hour_start;
    public $hour_end;
    public $duration;
    public $fee;

    public function updated()
    {
        if (($this->hour_start && $this->hour_end) != null) {
            $hour_start = Carbon::make($this->hour_start);
            $hour_end = Carbon::make($this->hour_end);
            $this->duration = $hour_start->diffInMinutes($hour_end);
            if ($this->duration < 60) {
                $this->fee = 20000;
            } else {
                $this->fee = ($this->duration / 60) * 20000;
                $this->fee = round($this->fee, -3);
            }
        }
    }

    public function render()
    {
        return view('livewire.request-form');
    }

    public function getSchedule($date, $id)
    {
        $this->date_select = $date;
        $schedule = Schedule::find($id);
        $this->min = $schedule->hour_start;
        $this->max = $schedule->hour_end;
    }

}
