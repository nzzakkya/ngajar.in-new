<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone',
        'address',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function detail()
    {
        return $this->hasOne('App\Models\UserDetail');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'user_skill');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\UserPayment');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
