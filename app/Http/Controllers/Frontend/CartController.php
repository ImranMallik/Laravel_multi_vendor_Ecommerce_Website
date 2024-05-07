<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    // Add item to the cart using AJAX______-------
    public function addToCart(Request $request)
    {
        dd($request->all());
    }
}
