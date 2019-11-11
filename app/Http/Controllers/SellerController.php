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
        //$data['name'] = $this->make_slug($data['name']);
        $slug = $this->make_slug($data['name']);
        //$data['description'] = $this->make_slug($data['description']);
        
        $seller = Seller::create($data + ['slug' => $slug]);
        
        
        cache()->forget('sellers');
        
        if (request()->wantsJson()) {
            return response($seller, 201);
        }
        
        return redirect(route('admin.sellers.index'))
            ->with('flash', 'Seller 생성됨');
    }
    
    public function make_slug($name)
    {
        //str_slug($name);
        $slug = preg_replace('/\s+/u','_', trim($name));
        return $slug;
    }
    
    
}
