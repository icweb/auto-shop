<?php

namespace App;

class Customer extends BaseModel
{
    protected $fillable = [
        'first_name',
        'last_name',
        'home_phone',
        'mobile_phone',
        'email',
        'comments',
        'email_reminders',
        'sms_reminders',
    ];
}
