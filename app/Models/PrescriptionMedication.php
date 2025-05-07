<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMedication extends Model
{
    protected $table = 'Prescription_Medication';
    protected $fillable = [
        'prescription_id',
        'medication_id'
    ];
    public $timestamps = false;

    // Relationships
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class, 'medication_id');
    }
}
