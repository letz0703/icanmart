<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use App\Seller;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }
    //
    public function index(Seller $seller)
    {
        if ($seller->exists){
            $boxes = $seller->boxes()->latest()->get();
        } else {
            $boxes = Box::latest()->get();
        }
        return view('boxes.index', compact('boxes') );
    }
    
    public function show($sellerName, Box $box)
    {
        $items = Item::where('box_id',$box->id)->latest()->get();
        
        return view('boxes.show', compact('box','items'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'seller_id' => 'required'
        ]);
        //dd($request->all());
        $box = Box::create([
            'seller_id' => request('seller_id'),
            'arrived_at' => request('arrived_at'),
            'title' => request('title'),
            'amount' => request('amount')
        ]);
        
        //if ( notNullValue($box->items->count)) {
        //    $box->update(['amount'=>$box->items->amount]);
        //}
        
        return redirect($box->path());
    
    }
    
    public function create()
    {
        return view('boxes.create');
    }
    
    
}
