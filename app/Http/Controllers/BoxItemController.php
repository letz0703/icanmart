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
        if ( request()->expectsJson()){
            $item->delete();
            return response(['status'=>'reply deleted']);
        }
        
        $item->delete();
        
        return redirect($box->path());
    }
    
}
