<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function showProduct(string $slug)
    {
        $product = Product::where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-details', compact('product'));
    }
}
