<?php

namespace App\Http\Controllers;

use App\UserRequest;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    //
    public function Store(Request $request)
    {
        $this->validate(request(), [
            'name'     => 'required',
            'email' => 'required',
            'question' => 'required',
            'verification' =>'required'
        ]);

        $request = UserRequest::create([
            'name' => request('name'),
            'email' => request('email'),
            'question' => request('question'),
            'verification' => request('verification')=== 5?true: false
        ]);


        return redirect()->back();

    }

}
