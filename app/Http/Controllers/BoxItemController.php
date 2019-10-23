<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;

class BoxItemController extends Controller
{
    public function index($seller, Box $box)
    {
        return $box->items()->paginate(20);
    }
    
    /**
     * @param          $sellerName
     * @param \App\Box $box
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update($sellerName, Box $box)
    {
        if (request()->has('locked')){
            if ( ! auth()->user()->isAdmin){
                return response('', 403);
            }
            $box->lock();
        }
        $box->update(request(['amount', 'paid']));
    }
    
    public function destroy($seller, Box $box, Item $item)
    {
        if (request()->expectsJson()){
            $item->delete();
            return response(['status' => 'item deleted']);
        }
        
        $item->delete();
        
        return redirect($box->path());
    }
}
