<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    use RecordActivity, Inventoriable;
    
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
    
    public function inventoryQuantity()
    {
        $barcodedItem= $this->inventories()->where('barcode', request('barcode'))->first();
        //dd($barcodedItem);
        if ($barcodedItem) {
            return $barcodedItem->quantity;
        }
    
        return ;
    
        //if ( $item->inventories->where($this->barcodeExist($this))){
        //    return $this->inventories->quantity;
        //}
        //dd($item->quantity);
        //
        //return $this->quantity;
    }
    
    //public function getInventoryQuantityAttribute()
    //{
    //    return $this->inventoryQuantity();
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
    
    //public function getRouteKeyName()
    //{
    //    return 'barcode';
    //}
    
}
