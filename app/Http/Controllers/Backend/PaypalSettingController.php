<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;

class PaypalSettingController extends Controller
{


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'status' => ['required', 'integer'],
            'mode' => ['required', 'integer'],
            'country' => ['required', 'max:200'],
            'currency' => ['required', 'max:200'],
            'currency_rate' => ['required'],
            'client_id' => ['required'],
            'secret_key' => ['required']
        ]);
        // dd($request->all());

        PaypalSetting::updateOrCreate(
            ['id' => $id],
            [
                'status' => $request->status,
                'mode' => $request->mode,
                'country' => $request->country,
                'currency' => $request->currency,
                'currency_rate' => $request->currency_rate,
                'client_id' => $request->client_id,
                'secret_key' => $request->secret_key
            ]
        );

        toastr('Update Successfully', 'success', 'Success');

        return redirect()->back();
    }
}
