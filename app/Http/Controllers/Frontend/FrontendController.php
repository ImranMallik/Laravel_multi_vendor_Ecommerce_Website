<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashItem;
use App\Models\FlashSale;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleItem = FlashItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        // dd($this->getTypeBaseProduct());
        $typeBaseProducts = $this->getTypeBaseProduct();
        $categoryProductsSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductsSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $productSliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();

        return view('frontend.home.dashboard', compact('sliders', 'flashSaleDate', 'flashSaleItem', 'popularCategory', 'brands', 'typeBaseProducts', 'categoryProductsSliderSectionOne', 'categoryProductsSliderSectionTwo', 'productSliderSectionThree'));
    }


    public function getTypeBaseProduct()
    {
        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = Product::where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['featured_product'] = Product::where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['top_product'] = Product::where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['best_product'] = Product::where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        return $typeBaseProducts;
    }
}
