<?php

namespace App\Services;

class CurrencyService
{
    public static function toDollars($cents)
    {
        return number_format(intval($cents) / 100, 2);
    }
}
