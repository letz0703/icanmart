<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    //
    public function index($barcode = null)
    {
        $items = Item::where('barcode', $barcode)->latest()->get();
        $latestItem = Item::where('barcode', $barcode)->latest()->first();
        return view('items.barcode',compact('latestItem','items'));
    }
    
}
