<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected static function boot(){
        parent::boot();
        static::addGlobalScope('itemCount', function($builder){
            $builder->withCount('items');
        });
        
        static::deleting( function($box){
            $box->items()->delete();
        });
        
        static::created( function($box){
            $box->recordActivity('created');
        });
    }
    
    public function recordActivity($eventType)
    {
        Activity::create([
            'user_id' => auth()->id(),
            'type' => $eventType.'_'.strtolower(class_basename($this)),
            'object_id' => $this->id,
            'object_type' => get_class($this)
        ]);
    }
    
    //
    protected $guarded = [];
    protected $with = ['seller','items'];
    
    
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
                    ;
    }
    
    public function addItem($item)
    {
        $this->items()->create($item);
        
        return back();
    }
    
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
    
    //public function sumUpItems()
    //{
    //   $this->update(['amount' => $this->items()->amount]);
    //}
    
    
}
