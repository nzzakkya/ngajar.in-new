<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use PDF;


class ClientController extends Controller
{
    //
    public function mentorList()
    {
        $mentors = User::where('role', 'mentor')->where('status', 'verified')->with('skills', 'detail', 'ratings')->get();
        $data = [
            'mentors' => $mentors
        ];

        return view('client.mentorList', $data);
    }

    public function mentorDetail(User $user)
    {

        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(30);
        $period = CarbonPeriod::create($startDate, $endDate);
        $schedules = $user->schedules;
        $dates = [];
        $sch = [];

        if ($schedules) {
            foreach ($period as $date) {
                foreach ($schedules as $schedule) {
                    if ($date->is($schedule->day)) {
                        $dates[] = $date->format('D, d-m-Y');
                        $sch[] = $schedule->id;
                    }
                }
            }
            $dates = array_combine($dates, $sch);
        }

        if ($user->ratings->isNotEmpty()) {
            $sum = $user->ratings->sum('rating');
            $count = $user->ratings->count('rating');
            $rating = round(($sum / $count), 1);
        }

        $data = [
            'user' => $user,
            'schedules' => $schedules,
            'dates' => $dates,
            'rating' => $rating ?? 0,
        ];

        return view('client.mentorDetail', $data);
    }

    public function chat(User $user)
    {
        $data = [
            'user' => $user,
        ];
        return view('client.chat-to-mentor', $data);
    }

    public function invoice(Order $order)
    {
    

        $data = [
            'order' => $order
        ];
        $pdf =  PDF::loadView('invoice', $data);
        return $pdf->stream();
    }
}
