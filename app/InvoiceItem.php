<?php

namespace App;

class InvoiceItem extends BaseModel
{
    protected $fillable = [
        'author_id',
        'invoice_id',
        'appointment_service_id',
        'rendered_service_id',
        'unit_price',
        'description',
        'quantity',
        'line_total',
    ];

    protected $appends = [
        'type'
    ];

    public function getTypeAttribute($value)
    {
        if($this->appointmentService !== null)
        {
            return 'Appointment Service';
        }
        else if($this->renderedService !== null)
        {
            return 'Rendered Service';
        }
        else
        {
            return 'Default';
        }
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function appointmentService()
    {
        return $this->belongsTo(AppointmentService::class);
    }

    public function renderedService()
    {
        return $this->belongsTo(RenderedService::class);
    }
}
