<?php

namespace App;

class Service extends BaseModel
{
    protected $fillable = [
        'author_id',
        'name',
        'cost',
        'comments',
    ];
}
