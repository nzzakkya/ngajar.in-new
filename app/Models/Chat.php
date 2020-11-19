<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'reciever_id',
        'chat'
    ];

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function reciever()
    {
        return $this->belongsTo('App\Models\User', 'reciever_id');
    }
}
