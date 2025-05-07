<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'Prescription';

    protected $primaryKey  = 'prescription_id';
    protected $fillable = [
        'date_issued',
        'expiration_date',
        'instructions',
        'status',
        'dosage',
        'refills_remaining',
        'patient_id',
        'doctor_id',
        'pharmacy_id'
    ];
    public $timestamps = false;

    // Relationships
    // Each prescription belongs to one patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    // Each prescription belongs to one doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    // Each prescription belongs to one pharmacy
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, 'pharmacy_id');
    }

    // Many-to-Many with Medication
    public function medications()
    {
        return $this->belongsToMany(
            Medication::class,
            'prescription_medication',
            'prescription_id',
            'medication_id'
        );
    }
}
