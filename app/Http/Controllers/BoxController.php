<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }
    //
    public function index()
    {
        $boxes = Box::latest()->get();
        return view('boxes.index', compact('boxes') );
    }
    
    public function show(Box $box)
    {
        $items = $box->items;
        return view('boxes.show', compact('box','items'));
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $box = Box::create([
            'seller_id' => request('seller_id'),
            'arrived_at' => request('arrived_at'),
            'title' => request('title'),
            'amount' => request('amount')
        ]);
        
        return redirect($box->path());
        
        
    }
    
    
}
