<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function showProduct(string $slug)
    {
        $product = Product::with(['vendorprofile', 'category', 'productImageGallery', 'ProductVariat', 'Brand'])->where('slug', $slug)->where('status', 1)->first();
        // $results = DB::table('product_variants')
        //     ->join('products', 'product_variants.product_id', '=', 'products.id')
        //     ->select('product_variants.*', 'products.id as product_id', 'products.name as product_name')
        //     ->get();
        // $productVariants = ProductVariant::with('product')->get();

        return view('frontend.pages.product-details', compact('product'));
    }
}
