<?php

namespace App;

class Customer extends BaseModel
{
    protected $fillable = [
        'author_id',
        'first_name',
        'last_name',
        'home_phone',
        'mobile_phone',
        'email',
        'comments',
        'email_reminders',
        'sms_reminders',
    ];

    public function setHomePhoneAttribute($value)
    {
        $this->attributes['home_phone'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function setMobilePhoneAttribute($value)
    {
        $this->attributes['mobile_phone'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function getHomePhoneAttribute($value)
    {
        return preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $value);
    }

    public function getMobilePhoneAttribute($value)
    {
        return preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $value);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class)->with(['mileage', 'renderedServices']);
    }

    public function renderedServices()
    {
        return $this->hasMany(RenderedService::class)->orderBy('completed_at', 'desc');
    }
}
