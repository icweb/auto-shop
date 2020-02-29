<?php

namespace App;

class Setting extends BaseModel
{
    public static function check($key)
    {
        $setting = Setting::findOrFail(1);
        return $setting->{$key};
    }
}
