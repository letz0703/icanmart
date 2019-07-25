<?php

namespace App\Http\Controllers\Api;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageUploadController extends Controller
{
    public function store(Item $item)
    {
        request()->validate([
            'image' => ['required', 'image']
        ]);
        
        $item->update([
            'image_path' => request()
                ->file('image')
                ->store('images','public')
        ]);
        
        
    }
}
