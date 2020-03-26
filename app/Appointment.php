<?php

namespace App;

class Appointment extends BaseModel
{
    protected $fillable = [
        'author_id',
        'customer_id',
        'color',
        'comments',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected $appends = [
        'link',
        'fg_color'
    ];

    public $colors = [
        '#B71C1C',
        '#880E4F',
        '#F50057',
        '#E65100',
        '#FFD600',
        '#2E7D32',
        '#01579B',
        '#283593',
        '#1565C0',
        '#311B92',
        '#4A148C',
        '#212121',
        '#4E342E',
        '#000000',
    ];

    public function getFgColorAttribute()
    {
        if (!$this->color) { return '#FFFFFF'; }
        return (intval(str_replace('#', '', $this->color), 16) > 0xffffff / 2) ? '#000000' : '#FFFFFF';
    }

    public function getLinkAttribute()
    {
        return route('appointments.show', $this);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function services()
    {
        return $this->hasMany(AppointmentService::class, 'appointment_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'appointment_id');
    }
}
