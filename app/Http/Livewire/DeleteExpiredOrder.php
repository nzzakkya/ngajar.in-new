<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class DeleteExpiredOrder extends Component
{
    public $order;
    public $now;
    public $hour_start;
    public $hour_end;
    public $status;
    public $condition;

    public function mount(){
        $this->now = Carbon::now();
        $this->hour_start = $this->order->hour_start;
        $this->hour_end = $this->order->hour_end;
        $this->status = $this->order->status;
        $isLess = $this->now->lessThan(Carbon::parse($this->order->day. ' ' .$this->hour_start));
        
        $isGoing = $this->now->between(Carbon::parse($this->order->day. ' ' .$this->hour_start), Carbon::parse($this->order->day. ' ' .$this->hour_end));
        $isFinish = $this->now->greaterThan(Carbon::parse($this->order->day. ' ' .$this->hour_end));
        if($isLess){
            $this->condition = 'waiting';
        }elseif($isGoing){
            $this->condition = 'waiting';
        }elseif($isFinish){
            $this->condition = 'over';
        }
        
    }
    
    public function render()
    {
        return view('livewire.delete-expired-order');
    }

    public function cancel(Order $order){
        $order->delete();

        return redirect()->route('dashboard.mentor-order-request', ['user' => auth()->user()]);
    }
}
