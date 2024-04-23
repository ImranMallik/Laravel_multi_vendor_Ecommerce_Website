<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashItem;
use App\Models\FlashSale;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleItem = FlashItem::where('show_at_home', 1)->where('status', 1)->get();
        return view('frontend.home.dashboard', compact('sliders', 'flashSaleDate', 'flashSaleItem'));
    }
}
