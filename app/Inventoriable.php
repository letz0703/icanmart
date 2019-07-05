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
        if ( ! $this->barcodeExist($item)){
            //if (false){
            $this->inventories()->create([
                'item_name' => $item->product_name,
                'barcode'   => $item->barcode,
                'quantity'  => $item->quantity,
            ]);
            return;
        }
        
        $this->updateInventoryQuantity($item);
        
    }
    
    public function barcodeExist($item)
    {
        return Inventory::where('barcode', $item->barcode)->exists();
    }
    
    public function updateInventoryQuantity($item)
    {
        $old_inventory = Inventory::where('barcode', $item->barcode)->first();
        $new_quantity = $old_inventory->quantity + $item->quantity;
        $old_inventory->update(['quantity' => $new_quantity]);
    }
}