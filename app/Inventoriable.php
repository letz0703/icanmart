<?php
/**
 * Created by letz.
 * User: letz
 * Date: 04/07/2019
 * Time: 11:57 PM
 */

namespace App;


trait Inventoriable
{
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
}