<?php

namespace App\Http\Controllers;

use App\Box;
use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    //
    
    public function show(User $user)
    {
        
        $boxes = Box::where('user_id', $user->id)->get();
        //dd($boxes);
        return view('profiles.show',[
            'profileUser' => $user,
            'boxes' => $boxes
        ]);
    }
    
}
