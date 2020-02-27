<?php

namespace App;

class AppointmentService extends BaseModel
{
    protected $fillable = [
        'author_id',
        'service_id',
        'appointment_id',
        'vehicle_id',
        'cost',
        'comments',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
