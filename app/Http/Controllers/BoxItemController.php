<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use Illuminate\Http\Request;

class BoxItemController extends Controller
{
    //
    public function destroy($seller, Box $box, Item $item)
    {
        //dd($item);
        //$item = $box->items()->where('id', $item)->get();
        $item->delete();
        
        return redirect($box->path());
    }
    
}
