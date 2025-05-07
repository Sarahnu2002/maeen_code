<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicationInteraction extends Model
{
    protected $table = 'medication_interactions';

    protected $fillable = [
        'medication_id',
        'interacts_with_id',
        'notes',
    ];

    public function medication()
    {
        return $this->belongsTo(Medication::class, 'medication_id');
    }

    public function interactsWith()
    {
        return $this->belongsTo(Medication::class, 'interacts_with_id');
    }
}
