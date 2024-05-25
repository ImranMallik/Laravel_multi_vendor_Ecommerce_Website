<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GenaralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    //

    public function index()
    {
        if (!Session::has('address')) {
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    // Order Store

    public function storeOrder($paymentMethod, $paymenyStatus, $transactionId, $paidAmount, $paidCurrencyName)
    {
        $setting = GenaralSetting::first();
        $order = new Order();
        $order->invocie_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->sub_total = getMainCartTotal();
        $order->amount = getFinalPayableAmount();
        $order->currency_name = $setting->currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->product_qty = \Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymenyStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 0;
        $order->save();

        // Store Order Product
        foreach (\Cart::content() as $item) {
            $product = Product::find($item->id);
            $orderProduct =  new OrderProduct();
            $orderProduct->oredr_id = $order->id;
            $orderProduct->produt_id = $item->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variants_total;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();
        }

        // store transaction details
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = getFinalPayableAmount();
        $transaction->amount_real_currency = $paidAmount;
        $transaction->amount_real_currency_name = $paidCurrencyName;
        $transaction->save();
    }

    // Clear All session after payment

    public function clearSession()
    {
        \Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }

    // paypal config
    public function paypalConfig()  //For Local box i use sandbox and live project use live paypal----------_______
    {
        $payPalSetting = PaypalSetting::first();
        $config = [
            'mode'    => $payPalSetting->mode === 1 ? 'sandbox' : 'live', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => $payPalSetting->client_id,
                'client_secret'     => $payPalSetting->secret_key,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $payPalSetting->client_id,
                'client_secret'     => $payPalSetting->secret_key,
                'app_id'            => '',
            ],

            'payment_action' =>  'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => $payPalSetting->currency,
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   =>  true, // Validate SSL when creating api client.
        ];

        return $config;
    }
    // Payment Paypal

    public function payWithPaypal()
    {
        // dd('Imran');
        $config = $this->paypalConfig();
        $payPalSetting = PaypalSetting::first();
        // dd($config);
        // die;
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        // $provider->setApiCredentials($config);

        // Calculate Paybal Monye
        $total = getFinalPayableAmount();
        $paybleAmount = round($total / $payPalSetting->currency_rate, 2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $paybleAmount
                    ]
                ]
            ]
        ]);

        // dd($response);
        // die;
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }


    public function paypalSuccess(Request $request)
    {
        // dd($request->all());
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // 
            $payPalSetting = PaypalSetting::first();
            $total = getFinalPayableAmount();
            $paidAmount = round($total / $payPalSetting->currency_rate, 2);
            $this->storeOrder('paypal', 1, $response['id'], $paidAmount, $payPalSetting->currency);
            // 
            $this->clearSession();
            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypal.cancel');
    }

    public function paypalCancel()
    {
        toastr('Something went wrong try agin later!', 'error', 'Error');
        return redirect()->route('user.paypal.cancel');
    }


    // Stripe COntroller 

    public function payWithStripe(Request $request)
    {
        // dd($request->all());
        $stripesetting = StripeSetting::first();
        $total = getFinalPayableAmount();
        $paybleAmount = round($total / $stripesetting->currency_rate, 2);
        // $paybleAmount = (int) $paybleAmount;
        // $finalAmount = round($paybleAmount / 74, 2);
        Stripe::setApiKey($stripesetting->secret_key);
        $response =  Charge::create([
            "amount" => $paybleAmount * 100,
            "currency" => $stripesetting->currency,
            "source" => $request->stripe_token,
            "description" => "Product Purchase!"
        ]);

        // dd('success');
        // dd($response);
        if ($response->status === 'succeeded') {
            $this->storeOrder('stripe', 1, $response->id, $paybleAmount, $stripesetting->currency);

            $this->clearSession();
            return redirect()->route('user.payment.success');
        } else {
            toastr('Something went worng try agin later!', 'error', 'Error');
            return redirect()->route('user.payment');
        }
    }
}
