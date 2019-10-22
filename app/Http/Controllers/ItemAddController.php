<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemAddController extends Controller
{
    //
    
    public function store()
    {
        
        $data = request()->validate([
            'product_name' => 'required',
            'barcode' => '',
            'quantity' => '',
            'buy_price' => '',
            'sell_price' =>'',
        ]);
        
        
        $item = Item::create($data);
        
        return redirect('/items/create')->with('flash','Item 생성됨');
    }
    
}
