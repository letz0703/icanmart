<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageUploadController extends Controller
{
    public function store()
    {
        request()->validate([
            'image' => ['required', 'image']
        ]);
    }
}
