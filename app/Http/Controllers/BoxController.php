<?php

namespace App\Http\Controllers;

use App\Box;
use App\Filters\BoxFilters;
use App\Notifications\BoxWasCreated;
use App\Seller;
use App\ViewedBoxes;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class BoxController
 * @package App\Http\Controllers
 */
class BoxController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create', 'destroy', 'update']);
    }
    
    //
    public function index(Seller $seller, BoxFilters $filters, ViewedBoxes $viewed)
    {
        $boxes = $this->getBoxes($seller, $filters);
        
        if (request()->wantsJson()){
            return $boxes;
        };
        
        return view('boxes.index', [
            'boxes'        => $boxes,
            'viewed_boxes' => $viewed->get(),
        ]);
    }
    
    public function show($sellerName, Box $box, ViewedBoxes $viewed)
    {
        $viewed->push($box);
        
        return view('boxes.show', compact('box'));
    }
    
    public function destroy($seller, Box $box)
    {
        //$box->items()->delete();
        $box->delete();
        
        if (request()->wantsJson()){
            return response([], 204);
        }
        
        return redirect('boxes');
    }
    
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'seller_id' => 'required',
        ]);
    
        $box = Box::create([
            'seller_id'  => request('seller_id'),
            'user_id'    => auth()->id(),
            'arrived_at' => request('arrived_at')?:Carbon::now()->format('Y-m-d'),
            'title'      => request('title'),
            'slug'       => request('title'),
            'amount'     => request('amount') ? : 0,
            'paid'       => request('paid'),
        ]);
        
        if (auth()->id() && auth()->id() !== request('user_id')){
            auth()->user()->notify(new BoxWasCreated($box));
        }
        
        //if ( notNullValue($box->items->count)) {
        //    $box->update(['amount'=>$box->items->amount]);
        //}
        
        return redirect($box->path())
            ->with('flash', 'Box Created');
        
    }
    
    public function update(Box $box)
    {
        //$this->authorize('update',$box);
        // if (request()->expectsJson()){
        // $box->update()
        // return response([], 202);
        // }
        
        //$box->update(request(['paid','amount']));
        // $box->update(request()->toArray());
        $box->update([
            'amount' => request('amount'),
            'paid'   => $box->paid,
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
        $boxes = Box::latest()->filter($filters)->paginate(10);
        
        if ($seller->exists){
            $boxes->where('seller_id', $seller->id);
            //$boxes = $seller->boxes()->latest();
        }
        
        //$boxes = $boxes->get();
        
        return $boxes;
    }
    
   
    
    
}
