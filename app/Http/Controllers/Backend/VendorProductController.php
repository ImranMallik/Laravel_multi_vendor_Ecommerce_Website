<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.products.index');
        // return view('vendor.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.products.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'product_type' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ]);

        $Product = new Product();
        // Image Upload----use Traits
        $iamgePath = $this->uploadImage($request, 'image', 'uploads');
        $Product->thumb_image = $iamgePath;
        $Product->name = $request->name;
        $Product->slug = Str::slug($request->name);
        $Product->vendor_id = Auth::user()->vendorprofile->id;
        $Product->category_id = $request->category;
        $Product->sub_category_id = $request->sub_category;
        $Product->child_category_id = $request->child_category;
        $Product->brand_id = $request->brand;
        $Product->qty = $request->qty;
        $Product->short_description = $request->short_description;
        $Product->long_description = $request->long_description;
        $Product->video_link = $request->video_link;
        $Product->sku = $request->sku;
        $Product->price = $request->price;
        $Product->offer_price = $request->offer_price;
        $Product->offer_start_date = $request->offer_start;
        $Product->offer_end_date = $request->offer_end;
        $Product->product_type = $request->product_type;
        $Product->status = $request->status;
        $Product->is_approved = 0;
        $Product->seo_title = $request->seo_title;
        $Product->seo_description = $request->seo_description;

        $Product->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('vendor.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSubCategories(Request $request)
    {
        // return $request->all();
        // dd($request->all());
        $subcategory = SubCategory::where('category_id', $request->id)->get();

        return $subcategory;
    }

    public function getChildCategories(Request $request)
    {
        // dd($request->all());
        $childCategory = ChildCategory::where('sub_category_id', $request->id)->get();

        return $childCategory;
    }
}
