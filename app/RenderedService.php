<?php

namespace App;

class RenderedService extends BaseModel
{
    protected $fillable = [
        'author_id',
        'employee_id',
        'service_id',
        'customer_id',
        'vehicle_id',
        'cost',
        'comments',
        'completed_at',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
