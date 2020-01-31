<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Item::class)->withTimestamps();
    }

}
