<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'mentor_id',
        'day',
        'hour_start',
        'hour_end',
        'duration',
        'fee',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'client_id');
    }

    public function mentor()
    {
        return $this->belongsTo('App\Models\User', 'mentor_id');
    }

    public function rating()
    {
        return $this->hasOne('App\Models\Rating');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }
}
