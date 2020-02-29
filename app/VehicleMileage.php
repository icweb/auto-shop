<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleMileage extends Model
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
