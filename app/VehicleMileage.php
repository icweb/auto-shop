<?php

namespace App;

class VehicleMileage extends BaseModel
{
    protected $table = 'vehicle_mileage';

    protected $fillable = [
        'author_id',
        'vehicle_id',
        'mileage',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
