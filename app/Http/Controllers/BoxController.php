<?php

namespace App\Http\Controllers;

use App\Box;
use App\Filters\BoxFilters;
use App\Item;
use App\Seller;
use Illuminate\Http\Request;

/**
 * Class BoxController
 * @package App\Http\Controllers
 */
class BoxController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create', 'destroy','update']);
    }
    
    //
    public function index(Seller $seller, BoxFilters $filters)
    {
        $boxes = $this->getBoxes($seller, $filters);
    
        return view('boxes.index', compact('boxes'));
    }
    
    public function show($sellerName, Box $box)
    {
        $items = Item::where('box_id', $box->id)->latest()->get();
        
        return view('boxes.show', compact('box', 'items'));
    }
    
    public function destroy($seller, Box $box)
    {
        //$box->items()->delete();
        $box->delete();
        
        if (request()->wantsJson()){
            return response([],204);
        }
        
        return redirect('boxes');
    }
    
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'seller_id' => 'required',
        ]);
        //dd($request->all());
        $box = Box::create([
            'seller_id'  => request('seller_id'),
            'user_id'  => request('user_id'),
            'arrived_at' => request('arrived_at'),
            'title'      => request('title'),
            'amount'     => request('amount'),
            'paid'     => request('paid'),
        ]);
        
        //if ( notNullValue($box->items->count)) {
        //    $box->update(['amount'=>$box->items->amount]);
        //}
        
        return redirect($box->path())
                ->with('flash', 'Box Created');
        
    }
    
    public function update($seller, Box $box)
    {
        //$this->authorize('update',$box);
        if (request()->expectsJson()){
            return response([], 202);
        }
        
        $box->update([
            'amount' => request('amount')
        ]);
    }
    
    
    public function create()
    {
        return view('boxes.create');
    }
    
    /**
     * @param Seller     $seller
     * @param BoxFilters $filters
     *
     * @return mixed
     */
    protected function getBoxes(Seller $seller, BoxFilters $filters)
    {
        $boxes = Box::latest()->filter($filters)->paginate(20);
        
        if ($seller->exists){
            $boxes->where('seller_id', $seller->id);
            //$boxes = $seller->boxes()->latest();
        }
        
        //$boxes = $boxes->get();
        
        return $boxes;
    }
    
}
