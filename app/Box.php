<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    //
    public function seller()
    {
        return $this->belongsTo('App\Seller','seller_id');
    }
    
    public function items()
    {
        return $this->hasMany('App\Item');
    }
    
    
}
