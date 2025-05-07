<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionDispense extends Model
{
    protected $table = 'prescription_dispenses';

    protected $fillable = [
        'prescription_id',
        'pharmacist_id',
        'dispensed_at',
        'status',
        'notes',
    ];

    protected $dates = ['dispensed_at'];

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    public function pharmacist(): BelongsTo
    {
        return $this->belongsTo(Pharmacist::class, 'pharmacist_id');
    }
}
