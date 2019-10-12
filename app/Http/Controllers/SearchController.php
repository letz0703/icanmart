<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function show()
    {
        $items = Item::search(request('query'))->get();
        dd($items);
    }
    
}
