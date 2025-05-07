<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'Notification';
    protected $fillable = [
        'content',
        'notification_type',
        'timestamp',
        'read_status',
        'sender_id',
        'receiver_id'
    ];
    public $timestamps = false;

    // Relationships
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
