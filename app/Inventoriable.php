<?php
/**
 * Created by letz.
 * User: letz
 * Date: 04/07/2019
 * Time: 11:57 PM
 */

namespace App;


use App\Notifications\OutOfStock;

trait Inventoriable
{
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
    
    public function addInventory($item)
    {
        if ( $this->barcodeExist($item)){
            $inventory = Inventory::where('barcode', $item->barcode)->first();
            //dd($inventory->quantity);
            $inventory->update([
                'quantity' => $inventory->quantity+ $item->quantity
            ]);
            
            //return $inventory;
        }
        
        $inventory = $this->inventories()->create([
            'item_name'              => $item->product_name,
            'barcode'                => $item->barcode,
            'quantity'               => $item->quantity,
            'minimum_stock_quantity' => $item->minimum_stock_quantity
        ]);
        //$this->updateInventoryQuantity($item);
    
        //if ($this->isOutOfStock($item)){
        //    $this->notifyOutOfStock($item);
        //}
        return $inventory;
        
    }
    
    public function notifyOutOfStock($item)
    {
        //$creator = User::where('id', $item->box->user_id)->get();
        //$creator->notify(new OutOfStock($item));
        auth()->user()->notify(new OutOfStock($item));
    }
    
    
    public function isOutOfStock($item)
    {
        //dd($this->inventories->first());
        return $item->inventories->first()->minimum_stock_quantity > $item->quantity;
    }
    
    
    public function reduceInventoryQuantity($item)
    {
        $inventory = Inventory::where('barcode', $item->barcode)->first();
        $inventory_quantity = $inventory->quantity;
        $reduced_quantity = $inventory_quantity - $item->quantity;
        $inventory->update(['quantity' => $reduced_quantity]);
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