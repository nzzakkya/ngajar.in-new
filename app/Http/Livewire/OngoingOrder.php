<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class OngoingOrder extends Component
{

    public $order;
    public $duration;
    public $hours;
    public $minutes;
    public $seconds;



    public function render()
    {

        $now = Carbon::now();
        $until = Carbon::make($this->order->day . ' ' . $this->order->hour_end);
        $this->duration = $until->diffInSeconds($now);
        $this->hours = floor($this->duration / 3600);
        $this->minutes = floor(($this->duration / 60) % 60);
        $this->seconds = $this->duration % 60;

        if($this->duration == 0){
            $this->stop();
        }

        return view('livewire.ongoing-order');
    }

    public function stop()
    {
        $this->order->status = 'finished';
        $this->order->save();
        session()->flash('status', 'Proses pembelajran selesai');
        return redirect()->route('dashboard.order-request', ['user' => auth()->user()]);
    }
}
