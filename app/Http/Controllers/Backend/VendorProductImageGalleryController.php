<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        // return
        $product = Product::findOrFail($request->product);
        //  Check Product Vendor Owner
        if ($product->vendor_id !== Auth::user()->vendorprofile->id) {
            abort(404);
        }
        return $dataTable->render('vendor.products.image-gallery.image', compact('product'));
        // return view('vendor.products.image-gallery.image');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $request->validate([
            'image.*' => ['required', 'image', 'max:2048']
        ]);

        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads');

        foreach ($imagePaths as $path) {
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->image = $path;
            $productImageGallery->product_id = $request->product;
            $productImageGallery->save();
        }

        toastr('Uploaded Successfully!', 'success');
        return redirect()->back();
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
        $product = ProductImageGallery::findOrFail($id);
        // dd($product->Product);
        //  Check Product Vendor Owner
        if ($product->Product->vendor_id !== Auth::user()->vendorprofile->id) {
            abort(404);
        }
        $this->deleteImage($product->image);
        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}