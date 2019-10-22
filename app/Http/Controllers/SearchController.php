<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use function compact;

class SearchController extends Controller
{
    //
    public function show()
    {
        //dd(request('query'));
        if (!request('query')){
            $items = Item::all();
        } else {
            $items = Item::search(request('query'))
                         ->get();
        }
        
        if (request()->wantsJson()){
            return $items;
        }
        return view('items.search',compact('items'));
    }
    
}
