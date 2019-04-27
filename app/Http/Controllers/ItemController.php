<?php

namespace App\Http\Controllers;

use App\Box;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Item::get();
        $items = Item::latest()->get();
        
        return view('items.index', compact('items'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     * @internal param Box $box
     *
     * @internal param Request $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required|exists:sellers, id',
        ]);
        
        $item = Item::create([
            'product_name' => request('product_name'),
            'quantity'     => request('quantity'),
            'buy_price'    => request('buy_price'),
            'category_id'  => request('category_id'),
            'seller_id'    => request('seller_id'),
        ]);
        
        //dd($item->path());
        //return back();
        return redirect($item->path());
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId, Item $item)
    {
        return view('items.show', compact('item'));
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Item                $item
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
