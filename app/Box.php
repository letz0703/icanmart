<?php

namespace App;

use App\Notifications\BoxWasCreated;
use App\Notifications\OutOfStock;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    
    use RecordActivity;
    
    protected $guarded = [];
    protected $with = ['seller','creator','items'];
    protected $appends= ['isPaid'];
    
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('itemCount', function ($builder){
            $builder->withCount('items');
        });
        
        static::created(function($box){
            $users = User::where('id','!=',$box->user_id)->get();
            foreach ($users as $user){
                $user->notify(new BoxWasCreated($box));
            }
        });
        
        static::deleting(function ($box){
            $box->items()->delete();
        });
        
    }
    
    public function path()
    {
        return "/boxes/{$this->seller->name}/{$this->id}";
    }
    
    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
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
        //foreach ($item->inventories as $inventory){
        //    if ( $inventory->minimum_stock_quantity > $inventory->quantity)
        //    {
        //        auth()->user()->notify(new OutOfStock($item));
        //    }
        //}
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
