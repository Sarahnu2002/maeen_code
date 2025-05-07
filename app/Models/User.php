<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    protected $table = 'User';

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'email',
        'phone',
        'status',
        'profile_info',
        'registration_date',
    ];
    public $timestamps = false;

    public function admin()
    {
        return $this->hasOne(Administrator::class, 'user_id');
    }
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'user_id');
    }

    public function pharmacist()
    {
        return $this->hasOne(Pharmacist::class, 'user_id');
    }

    public function sentNotifications()
    {
        return $this->hasMany(Notification::class, 'sender_id');
    }

    public function receivedNotifications()
    {
        return $this->hasMany(Notification::class, 'receiver_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name. ' '. $this->last_name;
    }
}
