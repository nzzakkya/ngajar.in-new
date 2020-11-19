<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schedules = auth()->user()->schedules;

        $data = [
            'schedules' => $schedules
        ];

        return view('mentor.schedule', $data);
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

        $user = User::find(auth()->user()->id);
        $checkSchedule = $user->schedules()->where('day', $request->day)->get();
        if ($checkSchedule->isEmpty()) {
            $schedule = new Schedule();
            $schedule->user_id = auth()->user()->id;
            $schedule->day = $request->day;
            $schedule->hour_start = $request->hour_start;
            $schedule->hour_end = $request->hour_end;
            $schedule->save();
            session()->flash('status', 'jadwal sukses dibuat !');
            return back();
        } else {
            session()->flash('status', 'Jadwal sudah ada !');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
        $request->validate([
            'day' => ['required'],
            'hour_start' => ['required', 'date_format:H:i'],
            'hour_end' => ['required', 'date_format:H:i', 'after:hour_start']
        ]);

        $user = User::find(auth()->user()->id);
        $checkSchedule = $user->schedules()->where('day', $request->day)->where('hour_start', $request->hour_start)->where('hour_end', $request->hour_end)->get();
        if ($checkSchedule->isEmpty()) {
            $schedule->day = $request->day;
            $schedule->hour_start = $request->hour_start;
            $schedule->hour_end = $request->hour_end;
            $schedule->save();
            session()->flash('status', 'jadwal sukses diupdate !');
            return back();
        } else {
            session()->flash('status', 'Jadwal sudah ada !');
            return back();
        }


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
        $schedule->delete();
        session()->flash('status', 'jadwal sukses dihapus !');
        return back();
    }
}
