<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserSkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard.index');
});
Route::view('/our-profile', 'dashboard.ourProfile')->name('our-profile');
Route::view('/our-contact', 'dashboard.contactUs')->name('our-contact');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/profile/edit', [DashboardController::class, 'editProfile'])->name('dashboard.edit.profile');
    Route::get('/dashboard/password/edit', [DashboardController::class, 'editPassword'])->name('dashboard.edit.password');
    Route::view('/dashboard/chat', 'dashboard.chat')->name('dashboard.chat');
    Route::get('/dashboard/mark-as-read-all', [NotificationController::class, 'markAsReadAll'])->name('dashboard.mark-as-read-all');
    

    Route::middleware(['client', 'verified'])->group(function () {
        Route::get('/dashboard/mentor-list', [ClientController::class, 'mentorList'])->name('dashboard.mentor-list');
        Route::get('/dashboard/mentor-detail/{user:name}', [ClientController::class, 'mentorDetail'])->name('dashboard.mentor-detail');
        Route::get('/dashboard/order-request/{user:name}', [OrderController::class, 'index'])->name('dashboard.order-request');
        Route::post('/dashboard/order-request', [OrderController::class, 'store'])->name('dashboard.add-order-request');
        Route::delete('/dashboard/order-request/{order:id}', [OrderController::class, 'destroy'])->name('dashboard.delete-order-request');
        Route::get('/dashboard/order-request/{order:id}/ongoing', [OrderController::class, 'ongoing'])->name('dashboard.ongoing-order-request');
        Route::get('/dashboard/chat/{user:name}', [ClientController::class, 'chat'])->name('dashboard.chat-to-mentor');

        Route::get('/dashboard/notification/handling', [NotificationController::class, 'handling'])->name('dashboard.notification.handling');
        Route::get('/dashboard/invoice/{order:id}', [ClientController::class, 'invoice'])->name('dashboard.invoice');
    });

    Route::middleware(['mentor', 'verified'])->group(function () {
        Route::get('/dashboard/schedule', [ScheduleController::class, 'index'])->name('dashboard.schedule');
        Route::post('dashboard/schedule', [ScheduleController::class, 'store'])->name('dashboard.add-schedule');
        Route::put('dashboard/schedule/{schedule:id}', [ScheduleController::class, 'update'])->name('dashboard.edit-schedule');
        Route::delete('dashboard/schedule/{schedule:id}', [ScheduleController::class, 'destroy'])->name('dashboard.delete-schedule');

        Route::get('/dashboard/skill', [UserSkillController::class, 'index'])->name('dashboard.skill');
        Route::post('/dashboard/skill/', [UserSkillController::class, 'store'])->name('dashboard.add-skill');
        Route::delete('/dashboard/skill/{id}', [UserSkillController::class, 'destroy'])->name('dashboard.delete-skill');

        Route::get('/dashboard/mentor-order-request/{user:name}', [MentorController::class, 'orderRequest'])->name('dashboard.mentor-order-request');
        Route::patch('/dashboard/mentor-order-request/{order:id}/accept', [MentorController::class, 'acceptRequest'])->name('dashboard.accept-mentor-order-request');
        Route::patch('/dashboard/mentor-order-request/{order:id}/decline', [MentorController::class, 'declineRequest'])->name('dashboard.decline-mentor-order-request');

        Route::view('/dashboard/user-payment', 'mentor.payment')->name('dashboard.user-payment');
        Route::post('/dashboard/user-payment/save', [MentorController::class, 'savePayment'])->name('dashboard.user-payment.save');
    });

    Route::middleware(['admin', 'verified'])->group(function () {
        Route::get('/dashboard/user-unverified', [AdminController::class, 'userUnverified'])->name('dashboard.user-unverified');
        Route::patch('/dashboard/user-unverified/{user:name}', [AdminController::class, 'verify'])->name('dashboard.verify');
        Route::get('/dashboard/user-verified', [AdminController::class, 'userVerified'])->name('dashboard.user-verified');
        Route::get('/dashboard/user-detail/{user:name}', [AdminController::class, 'userDetail'])->name('dashboard.user-detail');

        Route::get('/dashboard/user-skill', [SkillController::class, 'index'])->name('dashboard.user-skill');
        Route::post('/dashboard/user-skill', [SkillController::class, 'store'])->name('dashboard.add-user-skill');
        Route::patch('/dashboard/user-skill/{skill:id}', [SkillController::class, 'update'])->name('dashboard.edit-user-skill');
        Route::delete('/dashboard/user-skill/{skill:id}', [SkillController::class, 'destroy'])->name('dashboard.delete-user-skill');

        Route::get('/dashboard/payment-request', [AdminController::class, 'showPaymentRequest'])->name('dashboard.payment-request');
        Route::patch('/dashboard/payment-request/{payment:id}', [AdminController::class, 'PaymentProcess'])->name('dashboard.payment-request.process');
    });

    
});
