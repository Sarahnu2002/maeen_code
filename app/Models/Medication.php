<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'Medication';

    protected $primaryKey = 'medication_id';
    protected $fillable = [
        'name',
        'strength',
        'dosage_form',
        'barcode',
        'manufacturer',
        'interactions',
        'storage_conditions'
    ];
    public $timestamps = false;

    // Relationships
    // Many-to-Many with Prescription (via pivot table Prescription_Medication)
    public function prescriptions()
    {
        return $this->belongsToMany(
            Prescription::class,
            'Prescription_Medication',
            'medication_id',
            'prescription_id'
        );
    }


    public function interactions()
    {
        return $this->hasMany(MedicationInteraction::class, 'medication_id');
    }

    public function interactedBy()
    {
        return $this->hasMany(MedicationInteraction::class, 'interacts_with_id');
    }

}
