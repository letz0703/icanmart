<?php

namespace App\Http\Controllers;

use App\Box;
use Illuminate\Http\Request;

class LockedBoxController extends Controller
{
    public function store(Box $box)
    {
        //if ( ! $box->isAdmin()){
        //    return response('You do not have permission to lock!', 403);
        // middleware 'admin' is applied}
        $box->update(['locked' => true]);
    }
    
    public function destroy(Box $box)
    {
        $box->update(['locked' => false]);
    }
}
