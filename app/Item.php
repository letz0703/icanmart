<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public function path()
    {
        return '/items/'.$this->id;
    }
    
    public function box()
    {
        return $this->belongsTo('App\Box');
    }
    
    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }
    
    public function getAmountAttribute()
    {
        return $this->buy_price * $this->quantity;
    }
    
    
}
