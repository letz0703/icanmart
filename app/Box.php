<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    
    use RecordActivity;
    
    protected $guarded = [];
    protected $with = ['seller', 'creator', 'items'];
    protected $appends = ['isPaid'];
    protected $casts= [
        'locked' => 'boolean'
    ];
    
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('itemCount', function ($builder){
            $builder->withCount('items');
        });
        
        static::deleting(function ($box){
            // Letz 손봐야 함 $box->items->each->delete();
            $box->items()->delete();
        });
        
    }
    
    public function path()
    {
        return "/boxes/{$this->seller->name}/{$this->slug}";
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
    }
    
    public function lock()
    {
        $this->update(['locked' => true]);
    }
    
    public function unlock()
    {
        $this->update(['locked' => false]);
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
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function setSlugAttribute($value)
    {
        $slug = $this->make_slug($value);
        $origin = $slug;
        $count = 2;
        while (static::where('slug', $slug)->exists()){
            $slug = "{$origin}-" . $count++;
        }
        $this->attributes['slug'] = $slug;
    }
   
    function make_slug($string)
    {
        $slug = preg_replace('/\s+/u','-',trim($string));
        return $slug = str_slug($slug);
    }
    
}
