<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $table = 'Administrator';
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phone',
        'last_login',
        'date_created'
    ];
    public $timestamps = false;

    // Relationships
    // If you want to define a "manages" relationship to User,
    // you'll need either an admin_id in the User table or a pivot table.
    // For example:
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'admin_id');
    // }
}
