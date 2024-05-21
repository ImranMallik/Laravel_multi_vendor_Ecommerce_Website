<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    //

    public function index()
    {
        $shippingRoule = ShippingRule::where('status', 1)->get();
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        return view('frontend.pages.checkout', compact('addresses', 'shippingRoule'));
    }

    public function createCheckout(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required', 'max:200'],
            'phone' => ['required', 'max:200'],
            'email' => ['required', 'email'],
            'country' => ['required', 'max:200'],
            'state' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip' => ['required', 'max:200'],
            'address' => ['required', 'max:200']
        ]);

        $address = new UserAddress();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->zip = $request->zip;
        $address->address = $request->address;

        $address->save();

        toastr('Address created successfully!', 'success', 'Success');

        return redirect()->back();
    }

    public function checkoutFormSubmit(Request $request)
    {
        // 'shipping_method_id'
        $request->validate([
            'shipping_method_id' => ['required', 'integer'],
            'shipping_address_id' => ['required', 'integer']
        ]);

        $shippingMethod = ShippingRule::findOrFail($request->shipping_method_id);
        // dd($shippingMethod);
        if ($shippingMethod) {

            Session::put('shipping_method', [
                'id' => $shippingMethod->id,
                'name' => $shippingMethod->name,
                'type' => $shippingMethod->type,
                'cost' => $shippingMethod->cost
            ]);
        }

        $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        // dd($address);
        if ($address) {

            Session::put('address', $address);
        }


        return response(['status' => 'success', 'redirect_url' => route('user.payment')]);
    }
}
