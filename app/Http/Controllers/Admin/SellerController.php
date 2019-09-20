<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seller;
use Illuminate\Support\Facades\Cache;
use function str_slug;

class SellerController extends Controller
{
    public function index()
    {
        return view('admin.sellers.index')
            ->with('sellers', Seller::with('boxes')->get());
    }
    
    public function create()
    {
        return view('admin.sellers.create');
    }
    
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:sellers',
        ]);
        
        $seller = Seller::create($data+['slug'=>str_slug($data['name'])]);
        Cache::forget('sellers');
        
        if (request()->wantsJson()) {
            return response($seller, 201);
        }
    
        return redirect(route('admin.sellers.index'))
            ->with('flash', 'Your seller has been created');
    }
    
}
