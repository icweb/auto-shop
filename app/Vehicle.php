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
        'vin',
        'comments',
    ];

    protected $appends = [
        'last_seen',
        'last_mileage',
    ];

    public function getLastSeenAttribute()
    {
        $last_rendered_service = $this->renderedServices()->orderBy('id', 'desc')->first();

        if(isset($last_rendered_service->id) && $last_rendered_service->completed_at !== null)
        {
            return $last_rendered_service->completed_at->format('m/d/Y');
        }

        return 'Never';
    }

    public function getLastMileageAttribute()
    {
        $last_mileage = $this->mileage()->orderBy('id', 'desc')->first();

        if(isset($last_mileage->id) && $last_mileage->mileage !== null)
        {
            return $last_mileage->mileage;
        }

        return 0;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function mileage()
    {
        return $this->hasMany(VehicleMileage::class, 'vehicle_id')->with(['author']);
    }

    public function renderedServices()
    {
        return $this->hasMany(RenderedService::class, 'vehicle_id', 'id')->with(['customer', 'service', 'employee']);
    }
}
