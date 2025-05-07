<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'Patient';
    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'user_id',
        'medical_history',
        'address',
        'allergies',
        'insurance_info',
        'date_of_birth',
        'emergency_contact'
    ];
    public $timestamps = false;

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A patient can have many prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'patient_id');
    }
}
