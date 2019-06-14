<?php

namespace App\Http\Controllers;

use App\User;

class UserProfileController extends Controller
{
    
    public function show(User $user)
    {
        //$boxes = Box::where('user_id',$user->id);
        //$boxes = $user->boxes()->latest()->get();
        return view('profiles.show', [
            'profileUser' => $user,
            'boxes'       => $user->boxes()->paginate(10)
            //'boxes' => $boxes
        ]);
    }
    
}
