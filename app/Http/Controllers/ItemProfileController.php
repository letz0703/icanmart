<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemProfileController extends Controller
{
    //
    public function show(Item $item)
    {
        return view('items.profile', compact('item'));
    }
    
}
