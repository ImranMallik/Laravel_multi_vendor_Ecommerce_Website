<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashItem;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashItemDataTable $dataTable)
    {
        // return view();
        $flashSaleDate = FlashSale::first();
        $product = Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();

        return $dataTable->render('Admin.flash-sale.index', compact('flashSaleDate', 'product'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'end_date' => ['required']
        ]);

        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
        );

        toastr('Update Successfully!', 'success', 'Success');
        return redirect()->back();
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'add_product' => ['required'],
            'show_home' => ['required'],
            'status' => ['required']
        ]);

        $flashSaleDate = FlashSale::first();
        $flashSaleItem = new FlashItem();
        $flashSaleItem->product_id = $request->add_product;
        $flashSaleItem->flash_sale_id = $flashSaleDate->id;
        $flashSaleItem->show_at_home = $request->show_home;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();

        toastr('Product Added Successfully!', 'success', 'Success');

        return redirect()->back();
    }

    public function statusChange(Request $request)
    {
        // dd($request->all());
        // die;
        $changestatus = FlashItem::findOrFaild($request->id);
        $changestatus->status = $request->status == 'true' ? 1 : 0;
        $changestatus->save();

        return response(['message' => 'Status has been update!']);
    }

    public function showAtHome(Request $request)
    {
        $changestatus = FlashItem::findOrFaild($request->id);
        $changestatus->show_at_home = $request->status == 'true' ? 1 : 0;
        $changestatus->save();

        return response(['message' => 'Status has been update!']);
    }
}