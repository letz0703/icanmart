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
        
        $file = request()->file('image');
        
        $item->update([
            'image_path' => $file->store('images','public')
        ]);
        
        return response([], 204);
        
        //return back();
    }
}
