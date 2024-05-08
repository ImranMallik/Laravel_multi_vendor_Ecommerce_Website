<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    // Add item to the cart using AJAX______----------
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        // dd($request->all());
        // dd($request->variants_item);
        $variants = [];
        $variantTotalAmount = 0;

        if ($request->has('variants_item')) {
            foreach ($request->variants_item as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->ProductVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->ProductVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }
        // dd($variants);
        // Check Discount---
        $productTotalAmount = 0;
        if (checkDiscount($product)) {
            $productTotalAmount = ($product->offer_price + $variantTotalAmount);
        } else {
            $productTotalAmount = ($product->price + $variantTotalAmount);
        }


        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $product->qty;
        $cartData['price'] = $productTotalAmount;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        // dd($cartData);
        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Added to cart successfully!']);
    }
}
