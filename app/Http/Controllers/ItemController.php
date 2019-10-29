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
        $this->middleware('auth')->only(['store', 'destroy']);
    }
    
    public function index(ItemFilters $filters)
    {
        $items = $this->getItems($filters);
        
        if (request()->wantsJson()){
            return $items;
        }
        
        return view('items.index', compact('items'));
    }
    
    public function create()
    {
        return view('items.create');
    }
    
    public function store($sellerSlug, Box $box, Request $request)
    {
        if ($box->locked){
            return response('This Box is locked', 422);
        }
        
        $this->validate($request, [
            'product_name' => 'required',//'seller_id' => 'required|exists:sellers,id',
        ]);
        
        $sellerId = request('seller_id');
        
        $item = Item::create([
            'seller_id'    => $sellerId ? : $sellerId,
            'box_id'       => request('box_id') ? : null,
            'barcode'      => request('barcode') ? : null,
            'user_id'      => auth()->id(),
            'product_name' => request('product_name'),
            //'description' => request('description'),
            'quantity'     => request('quantity'),
            //'category_id'  => request('category_id'),
            'expire_date'  => request('expire_date'),
            'buy_price'    => request('buy_price'),
            'sell_price'   => request('sell_price') ? : null,
        ]);
        
        if ($item->barcodeExist($item)){
            $item->updateInventoryQuantity($item);
        }
        
        else {
            $item->addInventory($item);
        }
        
        if (request()->expectsJson()){
            return $item;
        }
        
        return redirect($item->path());
        
    }
    
    public function show(Item $item)
    {
        //$seller = $item->seller;
        //return view('items.show', compact('item', 'seller'));
        
        return view('items.show', compact('item'));
    }
    
    public function destroy(Item $item)
    {
        //$this->authorize('update', $item);
        if ($item->user_id != auth()->id()){
            return response([], 403);
        }
        $item->delete();
        return back();
    }
    
    function getItems(ItemFilters $filters)
    {
        $items = Item::filter($filters)->latest();
        
        //dd($items->toSql());
        return $items->get();
    }
    
    //public function updateInventory($barcode, $quantity)
    //{
    //    $item = Item::where('barcode',$barcode)->first();
    //    if ($item->inventory) {
    //        $itemInventoryQuantity = $item->inventory->quantity + $quantity;
    //        $item->inventory()->update(['quantiy'=> $itemInventoryQuantity);
    //    }
    //    else {
    //        create('App\Inventory',[
    //            'barcode' => $barcode,
    //            'quantity' => $quantity
    //        ]);
    //    }
    //
    //
    //}
    
    
}
