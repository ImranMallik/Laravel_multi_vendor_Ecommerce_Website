<?php

use Illuminate\Support\Facades\Session;

// set sidebar item active

function setActive(array $route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

// Chack Product has any offer price or not

function checkDiscount($product)
{
    $currentDate = date('Y-m-d');
    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {

        return true;
    }
    return false;
}
// Check offer calculation--------------
function calculateDiscountPercent($originalPrice, $discountPrice)
{
    $discountAmmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmmount / $originalPrice) * 100;
    return intval($discountPercent);
}

//Check product type-----------
function productType(string $type)
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product';
            return 'Top';
            break;
        case 'best_product';
            return 'Best';
            break;
        default:
            return '';
            break;
    }
}


// Get mini Cart total ammount

function getCartTotal()
{
    $total = 0;

    foreach (\Cart::content() as $product) {

        $total +=  ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}


function getMainCartTotal()
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subtotal = getCartTotal();
        if ($coupon['discount_type'] === 'amount') {
            $total = $subtotal - $coupon['discount_value'];

            return $total;
        } elseif ($coupon['discount_type'] === 'percent') {
            $discound = $subtotal - ($subtotal * $coupon['discount_value'] / 100);
            $total = $subtotal - $discound;

            return $total;
        }
    } else {
        return getCartTotal();
    }
}


// get Cart discount 

function getCartDiscount()
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subtotal = getCartTotal();
        if ($coupon['discount_type'] === 'amount') {
            // $total = getCartTotal() - $coupon['discount_value'];

            return $coupon['discount_value'];
        } elseif ($coupon['discount_type'] === 'percent') {
            $discound = $subtotal - ($subtotal * $coupon['discount_value'] / 100);
            // $total = $subtotal - $discound;

            return $discound;
        }
    } else {
        return 0;
    }
}


//Get shipping fee

function getShippingFee()
{
    if (Session::has('shipping_method')) {
        return Session::get('shipping_method')['cost'];
    } else {
        return 0;
    }
}


// Get Payable Amount
function getFinalPayableAmount()
{
    return getMainCartTotal() + getShippingFee();
}
