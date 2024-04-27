<?php

namespace App\Http\Controllers\Backend;

// use Config;
use App\Http\Controllers\Controller;
use App\Models\GenaralSetting;
use Illuminate\Http\Request;

class GenaralSettingController extends Controller
{
    //

    public function index()
    {
        $GenaralSetting = GenaralSetting::first();
        return view('Admin.setting.index', compact('GenaralSetting'));

        // $print_r($arry);
    }


    public function genaralSettingUpdate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'site_name' => ['required', 'max:200'],
            'layout' => ['required', 'max:200'],
            'contact_email' => ['required', 'max:200'],
            'currency_name' => ['required', 'max:200'],
            'currency_icon' => ['required', 'max:200'],
            'time_zone' => ['required', 'max:200'],
        ]);

        GenaralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_email' => $request->contact_email,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'time_zone' => $request->time_zone
            ]
        );


        toastr('Update succressfully!', 'success', 'Success');
        return  redirect()->back();
    }
}
