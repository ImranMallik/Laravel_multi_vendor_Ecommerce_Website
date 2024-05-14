<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Cart;
use Illuminate\Http\Request;
// use PHPUnit\Framework\Constraint\Count;

class CartController extends Controller
{


    // Cart details ---

    public function cartDetails(Request $request)
    {
        $cartItem = Cart::content();

        if (Count($cartItem) === 0) {
            toastr('Please add some products in your cart for view the cart pag!', 'warning', 'Warning');
            return redirect()->route('user.index');
        }
        // dd($cartItem);
        return view('frontend.pages.cart-details', compact('cartItem'));
    }


    // Add item to the cart using AJAX______----------
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->qty === 0) {
            return response(['status' => 'error', 'message' => 'Product Stock Out']);
        } else if ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

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
        $productPrice = 0;
        if (checkDiscount($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }


        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $product->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        // dd($cartData);
        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Added to Cart Successfully!']);
    }


    //Increment Product quentity---
    public function updateQty(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        // check product quantity
        if ($product->qty === 0) {
            return response(['status' => 'error', 'message' => 'Product stock out']);
        } elseif ($product->qty < $request->quantity) {
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }
        // dd($request->all());
        Cart::update($request->rowId, $request->quantity);
        // Function ka call korlam--
        $productTotal = $this->getProductTotal($request->rowId);

        return response(['status' => 'success', 'message' => 'Poruduct Quantity Updated!', 'product_total' => $productTotal]);
    }
    // increment product totel price

    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_totral) * $product->qty;
        return $total;
    }

    // Clera all cart Item----___

    public function clearAllCart()
    {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Cart Clear Successfully!']);
    }

    // Clear Singel Item---___

    public function removeProduct($rowId)
    {
        // dd($rowId);
        Cart::remove($rowId);
        toastr('Product removed succesfully!', 'success', 'Success');
        return redirect()->back();
    }


    // Count Cart Item ------_________

    public function countCartItem()
    {
        return Cart::content()->count();
    }


    //Add Product Mini Cart  

    public function addMiniCart()
    {
        return Cart::content();
    }

    // remove sidebar product in cart icon

    public function removeSidebarProduct(Request $request)
    {
        // dd($request->all());
        Cart::remove($request->rowId);

        return response(['status' => 'success', 'message' => 'Product remove Successfully!']);
    }


    // get cart sidebar item price 

    public function sidebarProductTotal()
    {
        $total = 0;

        foreach (Cart::content() as $product) {

            $total += $this->getProductTotal($product->rowId);
        }

        return $total;
    }
}
