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
        return view('admin.sellers.create');
    }
    
    public function store()
    {
        dd(request()->all());
        $data = request()->validate([
            'name'        => 'required',
            'description' => 'required',
        ]);
        
        $seller = Seller::create([
            'name' => request('name'),
            'description' => request('description'),
            'slug' => $this->make_slug(\request('name')),
            'phone' => request('phone')
        ]);
        
        \Illuminate\Support\Facades\Cache::forget('sellers');
        
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
