<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::orderby('name', 'asc')->get();
        return view('admin.sellers.index', compact('sellers'));
    }
    
    public function create()
    {
        return view('admin.sellers.create', [
            'sellers' => new Seller,
        ]);
    }
    
    public function store()
    {
        $data = request()->validate([
            'name'        => 'required',
            'description' => 'required',
        ]);
        
        $seller = Seller::create($data + ['slug' => str_slug($data['name'])]);
        
        
        cache()->forget('sellers');
        
        if (request()->wantsJson()) {
            return response($seller, 201);
        }
        
        return redirect(route('admin.sellers.index'))
            ->with('flash', 'Seller 생성됨');
    }
    
    public function make_slug($string)
    {
        $slug = pre_replace('/\s+/u', '-', trim($string));
        return $slug = str_slug($slug);
    }
    
    
}
