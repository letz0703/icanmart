<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    //
    protected $guarded = [];
    
    public function path()
    {
        return '/boxes/'.$this->id;
    }
    public function seller()
    {
        return $this->belongsTo('App\Seller','seller_id');
    }
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    public function addItem($item)
    {
        $this->items()->create($item);
        return back();
    }
    
    
}
