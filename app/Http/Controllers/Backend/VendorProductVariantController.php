<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);

        return $dataTable->render('vendor.products.product-variant.index',compact('product'));
        // return view('vendor.products.product-variant.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.products.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'product' => ['required','integer'],
            'status' =>['required']
        ]);

        $productVariant = new ProductVariant();

        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;

        $productVariant->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('vendor.products-variant.index',['product' => $request->product]);
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
        $productVariant = ProductVariant::findOrFail($id);
        return view('vendor.products.product-variant.edit',compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'status' =>['required']
        ]);

        $productVariant = ProductVariant::findOrFail($id);

        // $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;

        $productVariant->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('vendor.products-variant.index',['product' => $productVariant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = ProductVariant::findOrFail($id);
        $productVariantItem = ProductVariantItem::where('product_variant_id',$product->id)->count();
        if($productVariantItem > 0){
            return response(['status' => 'error','message'=>'This variant contain variant items in it delete the variant items first for delete this variant!']);
        }
        $product->delete();
        return response(['status' => 'success','message'=>'Deleted Successfully!']);
    }

    public function changeStatus(Request $request){
        $product = ProductVariant::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }
}
