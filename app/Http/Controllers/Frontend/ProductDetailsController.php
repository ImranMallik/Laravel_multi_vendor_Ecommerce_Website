<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductDetailsController extends Controller
{
    public function showProduct(string $slug)
    {
        $product = Product::with(['vendorprofile', 'category', 'productImageGallery', 'ProductVariat', 'Brand'])->where('slug', $slug)->where('status', 1)->first();


        return view('frontend.pages.product-details', compact('product'));
    }

    public function productIndex(Request $request)
    {
        // dd($request->all());
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $product = Product::where([
                'category_id' => $category->id,
                'status' => 1,
                'is_approved' => 1

            ])

                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    // dd($price);
                    $form = $price[0];
                    $to = $price[1];

                    return $query->where('price', '>=', $form)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('subcategory')) {
            $subcategory = SubCategory::where('slug', $request->subcategory)->firstOrFail();
            $product = Product::where([
                'sub_category_id' => $subcategory->id,
                'status' => 1,
                'is_approved' => 1

            ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    // dd($price);
                    $form = $price[0];
                    $to = $price[1];

                    return $query->where('price', '>=', $form)->where('price', '<=', $to);
                })->paginate(12);
        } elseif ($request->has('childcategory')) {
            $childcategory = ChildCategory::where('slug', $request->childcategory)->firstOrFail();
            $product = Product::where([
                'child_category_id' => $childcategory->id,
                'status' => 1,
                'is_approved' => 1

            ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    // dd($price);
                    $form = $price[0];
                    $to = $price[1];

                    return $query->where('price', '>=', $form)->where('price', '<=', $to);
                })->paginate(12);
        } elseif ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->firstOrFail();
            $product = Product::where([
                'brand_id' => $brand->id,
                'status' => 1,
                'is_approved' => 1

            ])
                ->when($request->has('range'), function ($query) use ($request) {
                    $price = explode(';', $request->range);
                    // dd($price);
                    $form = $price[0];
                    $to = $price[1];

                    return $query->where('price', '>=', $form)->where('price', '<=', $to);
                })
                ->paginate(12);
        } elseif ($request->has('search')) {
            $product = Product::where(['status' => 1, 'is_approved' => 1])
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orwhere('long_description', 'like', '%' . $request->search . '%')
                        ->orWhereHas('category', function ($query) use ($request) {
                            $query->where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('long_description', 'like', '%' . $request->search . '%');
                        });
                })
                ->paginate(12);
            // dd($product);
        } else {
            // Initialize $products to an empty collection
            $product = new LengthAwarePaginator([], 0, 12);
        }


        $category = Category::where(['status' => 1])->get();
        $brands = Brand::where(['status' => 1])->get();

        return view('frontend.pages.product', compact('product', 'category', 'brands'));
    }



    public function changeListView(Request $request)
    {
        // dd('hello');
        Session::put('product_list_style', $request->style);
    }
}
