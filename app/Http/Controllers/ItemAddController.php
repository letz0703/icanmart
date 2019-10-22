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
        
        if (request('barcode')){
            return back()->with('flash', 'barcode_exist');
            //$old = Item::where('barcode',request('barcode'))
            //    ->orderBy('created_at', 'desc')->first();
            //$data['product_name'] = $old->product_name;
        }
        
        $item = Item::create($data);
        
        if (request('barcode')){
            return back()->with('flash', 'barcode_exist');
            //$old = Item::where('barcode',request('barcode'))
            //    ->orderBy('created_at', 'desc')->first();
            //$data['product_name'] = $old->product_name;
        }
        return redirect('/items/create')->with('flash','Item 생성됨');
    }
    
}
