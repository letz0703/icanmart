<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    //
    public function store()
    {
        $seller = create('App\Store', request()->all());
        
        return redirect(route('admin.sellers.index'));
    }
    
}
