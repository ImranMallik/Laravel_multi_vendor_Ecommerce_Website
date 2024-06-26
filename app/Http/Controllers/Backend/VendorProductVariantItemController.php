<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantItemController extends Controller
{
    public function index(VendorProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        // Check Produvt vendor owner


        $variant = ProductVariant::findOrFail($variantId);

        return $dataTable->render('vendor.products.product-variant-item.index', compact('product', 'variant'));
    }

    public function create(string $productId, string $variantId)
    {
        $productVariant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return view('vendor.products.product-variant-item.create', compact('productVariant', 'product'));
        return 'Ok';
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'variant_id' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'price' => ['required', 'integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productvariantitem = new ProductVariantItem();
        $productvariantitem->product_variant_id = $request->variant_id;
        $productvariantitem->name = $request->name;
        $productvariantitem->price = $request->price;
        $productvariantitem->is_default = $request->is_default;
        $productvariantitem->status = $request->status;
        $productvariantitem->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('vendor.product-variant-item.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);
    }

    public function edit(string $variantItemId)
    {
        // return "Ok";
        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        return view('vendor.products.product-variant-item.edit', compact('variantItem'));
    }

    public function update(Request $request, string $variantItemId)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['required', 'integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productvariantitem = ProductVariantItem::findOrFail($variantItemId);
        // $productvariantitem->product_variant_id = $request->variant_id;
        $productvariantitem->name = $request->name;
        $productvariantitem->price = $request->price;
        $productvariantitem->is_default = $request->is_default;
        $productvariantitem->status = $request->status;
        $productvariantitem->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('admin.product-variant-item.index', ['productId' => $productvariantitem->ProductVariant->product_id, 'variantId' => $productvariantitem->product_variant_id]);
    }

    public function destroy(string $variantItemId)
    {
        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        $variantItem->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $variantItem = ProductVariantItem::findOrFail($request->id);
        $variantItem->status = $request->status == 'true' ? 1 : 0;
        $variantItem->save();

        return response(['message' => 'Status has been updated!']);
    }
}
