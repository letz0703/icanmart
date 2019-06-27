<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;

class BoxItemController extends Controller
{
    public function index($seller, Box $box)
    {
        return $box->items()->paginate(1);
    }
    
    //
    public function destroy($seller, Box $box, Item $item)
    {
        if (request()->expectsJson()){
            $item->delete();
            return response(['status' => 'reply deleted']);
        }
        
        $item->delete();
        
        return redirect($box->path());
    }
    
}
