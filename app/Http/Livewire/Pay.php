<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Pay extends Component
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
            $this->condition = 'pay';
        }elseif($isGoing){
            $this->condition = 'ongoing';
        }elseif($isFinish){
            $this->condition = 'over';
        }
        
    }

    public function render()
    {
        return view('livewire.pay');
    }

    public function pay(Order $order)
    {
        Config::$serverKey = 'SB-Mid-server-hHE4EtJDMWsMRnkfWkMV6SOS';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;


        $params = array(
            'transaction_details' => array(
                'order_id' => $order->order_id,
                'gross_amount' => $order->fee,
            ),
            'customer_details' => array(
                'first_name' => $order->client->name,
                'email' => $order->client->email,
                'phone' => $order->client->phone,
            ),
        );
        $link = Snap::createTransaction($params);
        return redirect()->away($link->redirect_url);
    }
}
