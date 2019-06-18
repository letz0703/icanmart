<?php

namespace App\Http\Controllers;

use App\Box;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function update(Box $box)
    {
        $this->authorize('update',$box);
        $box->update([
            'paid' => request('paid'),
        ]);
    }
}
