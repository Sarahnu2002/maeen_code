<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'Chat';

    protected $primaryKey = 'chat_id';

    public $timestamps = false;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'dateTime'
    ];


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
