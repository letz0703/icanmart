<?php

namespace App\Http\Controllers;

use App\UserRequest;
use http\Exception;
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

        $userRequest = UserRequest::create([
            'name' => request('name'),
            'email' => request('email'),
            'question' => request('question'),
            'verification' => request('verification'),
        ]);




        //return redirect()->back();

    }

}
