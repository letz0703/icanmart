<?php

namespace App\Http\Controllers;

use App\Box;
use App\Filters\ItemFilters;
use App\Item;
use App\Seller;
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
     * @param ItemFilters $filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemFilters $filters)
    {
        $items = $this->getItems($filters);
    
        return view('items.index', compact('items'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *box
     *
     * @return \Illuminate\Http\Response
     * @internal param Box $box
     *
     * @internal param Request $request
     */
    public function store($sellerName = null, $boxId = null, Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required|exists:sellers,id',
        ]);
        
        if ($sellerName && $boxId){
            $sellerId = Seller::where('name', $sellerName)->first()->id;
            $item = Item::create([
                'seller_id'    => $sellerId,
                'box_id'    => $boxId,
                'product_name' => request('product_name'),
                'quantity'     => request('quantity'),
                //'category_id'  => request('category_id'),
                'buy_price'    => request('buy_price'),
                'expire_date'    => request('expire_date'),
            ]);
            
            return back();
        } else{
            $item = Item::create([
                'seller_id'    => request('seller_id'),
                'barcode'      => request('barcode'),
                'product_name' => request('product_name'),
                'quantity'     => request('quantity'),
                'expire_date'  => request('expire_date'),
                'buy_price'    => request('buy_price'),
                'sell_price'   => request('sell_price'),
                //'category_id'  => request('category_id'),
            ]);
            return redirect($item->path());
        }
    
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //$seller = Seller::where('id',$item->seller_id)->get();
        return view('items.show', compact('item','seller'));
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
    
    /**
     * @param ItemFilters $filters
     *
     * @return mixed
     */
    protected function getItems(ItemFilters $filters)
    {
        return Item::latest()->filter($filters)->get();
    }
    
    /**
     * @return mixed
     */
    //protected function getItems(ItemFilters $filters)
    //{
    //    //return Item::get();
    //    //$items = Item::latest();
    //    Item::filter($filters)->get();
    //
    //
    //    return $items;
    //}
}
