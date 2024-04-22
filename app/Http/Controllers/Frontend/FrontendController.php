<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        return view('frontend.home.dashboard', compact('sliders', 'flashSaleDate'));
    }
}
