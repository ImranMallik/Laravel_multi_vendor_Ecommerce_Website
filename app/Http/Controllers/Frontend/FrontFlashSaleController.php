<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashItem;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class FrontFlashSaleController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();
        $flashSaleItem = FlashItem::where('status', 1)->orderBy('id', 'ASC')->paginate(20);
        return view('frontend.pages.flash-sale', compact('flashSaleDate', 'flashSaleItem'));
    }
}
