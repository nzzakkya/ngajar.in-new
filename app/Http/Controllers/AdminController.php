<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function userUnverified()
    {
        $users = User::where('status', 'unverified')->get();
        $data = [
            'users' => $users
        ];
        return view('admin.unverified', $data);
    }

    public function userVerified()
    {
        $users = User::where('status', 'verified')->get();
        $data = [
            'users' => $users
        ];
        return view('admin.verified', $data);
    }

    public function userDetail(User $user)
    {
        $data = [
            'user' => $user
        ];
        return view('admin.userDetail', $data);
    }

    public function verify(User $user)
    {
        $user->status = 'verified';
        $user->save();
        return back();
    }

    public function showPaymentRequest()
    {
        $data = [
            'payments' => Payment::get(),
        ];
        return view('admin.paymentRequest', $data);
    }

    public function PaymentProcess(Payment $payment)
    {
        $payment->status = 'finished';
        $payment->save();

        session()->flash('status', 'Pembayaran berhasil dilakukan');
        return back();
    }
}
