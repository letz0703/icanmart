<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    use RecordActivity;
    
    protected $guarded = [];
    protected $with = ['seller'];
    
    //
    public function path()
    {
        return '/items/' . $this->id;
    }
    
    public function box()
    {
        return $this->belongsTo('App\Box');
    }
    
    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }
    
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
    
    public function addInventory($item)
    {
        if (! $this->barcodeExist($item)){
        //if (false){
            $this->inventories()->create([
                'barcode'  => $item->barcode,
                'quantity' => $item->quantity,
            ]);
            return ;
        }
        
        $this->updateInventoryQuantity($item);
        
    }
    
    public function barcodeExist($item)
    {
        return Inventory::where('barcode',$item->barcode)->exists();
    }
    
    public function updateInventoryQuantity($item)
    {
        $old_item = Inventory::where('barcode',$item->barcode)->first();
        $quantity = $old_item->quantity + $item->quantity;
        $old_item->update(['quantity'=>$quantity]);
    }
    
    //public function getRouteKeyName()
    //{
    //    return 'barcode';
    //}
    
    public function getAmountAttribute()
    {
        return $this->buy_price * $this->quantity;
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
    
   
    
    
}
