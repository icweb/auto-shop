<?php

namespace App;

class Appointment extends BaseModel
{
    protected $fillable = [
        'author_id',
        'customer_id',
        'comments',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function services()
    {
        return $this->hasMany(AppointmentService::class, 'appointment_id');
    }
}
