<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;

class PaumentSettingController extends Controller
{
    //

    public function index()
    {
        $PaypalSetting = PaypalSetting::first();
        return view('Admin.payment-setting.index', compact('PaypalSetting'));
    }
}
