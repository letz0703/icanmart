<?php

namespace App\Http\Controllers;

use App\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    //
    public function index()
    {
        $boxes = Box::latest()->get();
        return view('boxes.index', compact('boxes') );
    }
    
    public function show(Box $box)
    {
        $items = $box->items;
        return view('boxes.show', compact('box','items'));
    }
    
}
