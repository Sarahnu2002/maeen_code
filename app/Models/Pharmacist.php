<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacist extends Model
{
    protected $table = 'Pharmacist';
    protected $primaryKey = 'pharmacist_id';

    protected $fillable = [
        'user_id',
        'shift_timings',
        'qualification',
        'employee_number'
    ];
    public $timestamps = false;

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // If you want to link Pharmacist to a Pharmacy:
    // (Requires a `pharmacy_id` foreign key in 'Pharmacist' table, if applicable)
    // public function pharmacy()
    // {
    //     return $this->belongsTo(Pharmacy::class, 'pharmacy_id');
    // }
}
