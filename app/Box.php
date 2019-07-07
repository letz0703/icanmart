<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    
    use RecordActivity;
    
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('itemCount', function ($builder){
            $builder->withCount('items');
        });
        
        static::deleting(function ($box){
            $box->items()->delete();
        });
        
    }
    
    //
    protected $guarded = [];
    protected $with = ['seller', 'items'];
    protected $appends= ['isPaid'];
    
    
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
        
        return $this;
    }
    
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
    
    public function isPaid()
    {
        return ! ! $this->paid;
    }
    
    public function getIsPaidAttribute()
    {
        return $this->isPaid();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    
    
    //public function sumUpItems()
    //{
    //   $this->update(['amount' => $this->items()->amount]);
    //}
    
    
}
