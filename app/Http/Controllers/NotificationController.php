<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function handling(Request $request)
    {
        if($request == null){
            return redirect()->route('dashboard');
        }

        if ($request->status_code == 200) {
            $order = Order::where('order_id', $request->id)->first();
            $order->status = 'payment successful';
            $order->save();
            session()->flash('status', 'pembayaran sukses asekk');
            return redirect()->route('dashboard.order-request', ['user' => auth()->user()]);
        } elseif ($request->status_code == 201) {
            session()->flash('status', 'pembayaran gagal');
            return redirect()->route('dashboard.order-request', ['user' => auth()->user()]);
        }
    }

    public function markAsReadAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}
