<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemProfileController extends Controller
{
    //
    public function show(Item $item)
    {
        $purchase_history = Item::where('product_name', $item->product_name)
                                ->latest()->get();
        
        return view('items.profile', [
            'item' => $item,
            'orders' => $purchase_history
        ]);
    }
    
}
