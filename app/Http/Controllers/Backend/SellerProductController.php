<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductsDataTable;
use App\DataTables\SellerProductsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index(SellerProductsDataTable $dataTable)
    {
        // return view('Admin.product.seller-product.index');
        return $dataTable->render('Admin.product.seller-product.index');
    }


    public function pendingProducts(SellerPendingProductsDataTable $dataTable)
    {
        // return view('Admin.product.vendor-pending-product.index');s
        return $dataTable->render('Admin.product.vendor-pending-product.index');
    }

    public function changeApproveStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();
        return response(['message' => 'Product Approve status Has Been Changed']);
    }
}
