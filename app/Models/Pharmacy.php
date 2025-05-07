<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $table = 'Pharmacy';

    protected $primaryKey = 'pharmacy_id';
    protected $fillable = [
        'pharmacy_name',
        'address',
        'phone',
        'email',
        'contact_information',
        'city',
        'state',
        'zip_code'
    ];
    public $timestamps = false;

    // Relationships
    // A pharmacy can have many prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'pharmacy_id');
    }

    // If you want to link Pharmacist to Pharmacy,
    // and if there's a foreign key in Pharmacist table:
    // public function pharmacists()
    // {
    //     return $this->hasMany(Pharmacist::class, 'pharmacy_id');
    // }
}
