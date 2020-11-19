<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class RequestPayment extends Component
{
    public $order;

    public function render()
    {
        return view('livewire.request-payment');
    }

    public function request()
    {
        if (auth()->user()->payment) {
            $payment = new Payment();
            $payment->user_id = auth()->user()->id;
            $payment->order_id = $this->order->id;
            $payment->fee = $this->order->fee;
            $payment->status = 'requested';
            $payment->save();
        }else{
            session()->flash('status', 'Anda belum mengatur akun pembayaran');
        }

        $previous = URL::previous();
        return redirect($previous);
    }
}
