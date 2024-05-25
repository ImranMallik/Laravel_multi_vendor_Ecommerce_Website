<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaumentSettingController extends Controller
{
    //

    public function index()
    {
        $PaypalSetting = PaypalSetting::first();
        $StripeSetting = StripeSetting::first();
        return view('Admin.payment-setting.index', compact('PaypalSetting', 'StripeSetting'));
    }
}
