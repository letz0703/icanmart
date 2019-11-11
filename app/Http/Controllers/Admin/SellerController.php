<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
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
    
    public function edit(Seller $seller)
    {
        return view('admin.sellers.edit', compact('seller'));
    }
    
    public function store()
    {
        $data = request()->validate([
            'name'        => 'required',
            'description' => 'required',
            'phone'       => '',
        ]);
        
        //$seller = Seller::create($data + ['slug' => str_slug($data['name'])]);
        $seller = Seller::create($data + [
                'slug' => $this->make_slug($data['name']),
            ]);
        
        
        cache()->forget('sellers');
        
        if (request()->wantsJson()) {
            return response($seller, 201);
        }
        
        return redirect(route('admin.sellers.index'))
            ->with('flash', 'Seller 생성됨');
    }
    
    public function update(Seller $seller)
    {
        $this->validate(request(), [
            'name'        => [
                'required', Rule::unique('sellers')
                                ->ignore($seller->id),
            ],
            //'description' => 'required|spamfree',
            //'archived'    => 'required|boolean',
        ]);
        
        $seller->update([
            'name'        => request('name'),
            'slug'        => $this->make_slug(request('name')),
            'description' => request('description'),
            'phone'    => request('phone'),
        ]);
        
        cache()->forget('sellers');
        
        if (request()->wantsJson()) {
            return response($seller, 200);
        }
        
        return redirect(route('admin.sellers.index'))
            ->with('flash', 'Seller has been updated');
    }
    public function make_slug($string)
    {
        $slug = preg_replace('/\s+/u', '-', trim($string));
        return $slug = str_slug($slug);
    }
    
}
