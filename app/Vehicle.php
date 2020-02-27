<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'author_id',
        'customer_id',
        'make',
        'model',
        'year',
        'color',
        'body_type',
        'license_plate',
        'comments',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function mileage()
    {
        return $this->hasMany(VehicleMileage::class, 'vehicle_id');
    }
}
