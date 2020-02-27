<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $casts = [
        'deleted_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
