<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        //

        $product = Product::findOrFail($request->product);

        return $dataTable->render('Admin.product.product-variant.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('Admin.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // dd($request->all());
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
        return redirect()->route('admin.products-variant.index',['product' => $request->product]);
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
}
