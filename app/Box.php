<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    
    //
    protected $guarded = [];
    
    
    public function path()
    {
        return "/boxes/{$this->seller->name}/{$this->id}";
    }
    
    public function seller()
    {
        return $this->belongsTo(Seller::class);
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
    
    //public function sumUpItems()
    //{
    //   $this->update(['amount' => $this->items()->amount]);
    //}
    
    
}
