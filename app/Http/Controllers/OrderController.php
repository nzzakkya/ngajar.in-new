<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //
        $orders = Order::where('client_id', $user->id)->with('client', 'mentor')->paginate(2);
        $date_now = Carbon::now();
        $data = [
            'orders' => $orders,
            'date_now' => $date_now
        ];

        return view('client.orderRequest', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'day' => ['required'],
            'hour_start' => ['required', 'date_format:H:i'],
            'hour_end' => ['required', 'date_format:H:i', 'after:hour_start']
        ]);

        $check = Order::where('client_id', auth()->user()->id)->where('mentor_id', $request->mentor_id)->where('status', '!=' , 'finished' )->get();
        if ($check->isEmpty()) {
            $hour_start = Carbon::make($request->hour_start);
            $hour_end = Carbon::make($request->hour_end);
            $request->duration = $hour_start->diffInMinutes($hour_end);

            $order = new Order();
            $order->order_id = Str::uuid();
            $order->client_id = auth()->user()->id;
            $order->mentor_id = $request->mentor_id;
            $order->day = $request->day;
            $order->hour_start = $request->hour_start;
            $order->hour_end = $request->hour_end;
            $order->duration = $request->duration;
            if ($order->duration < 60) {
                $order->fee = 20000;
            } else {
                $order->fee = ($request->duration / 60) * 20000;
                $order->fee = round($order->fee, -3);
            }
            $order->status = 'pending';
            $order->save();
            session()->flash('status', 'Order request sukses, tolong entenono mentor e acc yoo !');
            return back();
        } else {
            session()->flash('status', 'Order request telah ada, tolong entenono sek lah !');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();

        session()->flash('status', 'Order request berhasil dibatalkan, alhamdulilah :) !');
        return back();
    }

    public function ongoing(Order $order) 
    {
        if($order->status != 'ongoing'){
            return redirect()->route('dashboard.order-request', ['user' => auth()->user()]);
        }

        $data = [
            'order' => $order
        ];
        return view('client.ongoingOrderRequest', $data);
    }
}
