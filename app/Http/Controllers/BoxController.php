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

    public function store()
    {
        $this->validate(request(), [
            'title'     => 'required',
            'seller_id' => 'required',
            'title' => 'required'
        ]);

        $box = Box::create([
            'seller_id'  => request('seller_id'),
            'user_id'    => auth()->id(),
            'arrived_at' => request('arrived_at'),
            'title'      => request('title'),
            'slug'       => request('arrived_at'),
            'amount'     => request('amount') ? : 0,
            'paid'       => request('paid'),
        ]);

        if (auth()->id() && auth()->id() !== request('user_id')){
            auth()->user()->notify(new BoxWasCreated($box));
        }

        return redirect($box->path())
            ->with('flash', 'Box Created');

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

    public function update($sellerName, Box $box)
    {
        //$box->update(request(['paid','amount']));
        // $box->update(request()->toArray());
        if ( request()->has('locked')){
            if (! auth()->user()->isAmin()){
               return response('',403);
            }
        }


        $box->update([
            'title' => 'changed',
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
        $boxes = Box::filter($filters)->latest();

        if ($seller->exists){
            $boxes->where('seller_id', $seller->id);
            //$boxes = $seller->boxes()->latest();
        }
        return $boxes->paginate(10);
    }




}
