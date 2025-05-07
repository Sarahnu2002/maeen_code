<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'Doctor';

    protected $primaryKey = 'doctor_id';
    protected $fillable = [
        'user_id',
        'specialization',
        'department',
        'clinic_address',
        'license_number',
        'work_hours'
    ];
    public $timestamps = false;

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A doctor can create many prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'doctor_id');
    }
}
