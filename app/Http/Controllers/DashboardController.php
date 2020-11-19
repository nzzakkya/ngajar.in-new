<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if(auth()->user()->status == 'unverified'){
            session()->flash('status', 'Akun anda masih belum diverifikasi admin, haraap tunggu');
        }
        return view('dashboard.index');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function editProfile()
    {
        return view('dashboard.editProfile');
    }

    public function editPassword()
    {
        return view('dashboard.editPassword');
    }
}
