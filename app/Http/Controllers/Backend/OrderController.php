<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CanceledOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\droppedOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\OutOfDeliveredOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        //
        return $dataTable->render('admin.order.index');
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
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $order = Order::findOrFail($id);
        return view('Admin.order.show', compact('order'));
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
        $order = Order::findOrFail($id);
        // Order Product Delete
        $order->OrderProduct()->delete();
        // Transation delete
        $order->transaction()->delete();
        $order->delete();
        return response()->json(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }


    // change Order Status

    public function orderStatusChange(Request $request)
    {
        // dd('Imran');
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => 'Update order status']);
    }

    public function paymentStatusChange(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->payment_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => 'Update Payment status']);
    }

    // show panding Order
    public function pendingOrders(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('Admin.order.pending');
    }

    // Processed Order

    public function processedOrders(ProcessedOrderDataTable $dataTable)
    {
        return $dataTable->render('Admin.order.processed');
    }

    //Dropped Order
    public function droppedOrders(droppedOrderDataTable $dataTable)
    {
        return $dataTable->render('Admin.order.dropped-off');
    }
    // Shipped Order

    public function shippedOrders(ShippedOrderDataTable $dataTable)
    {
        return $dataTable->render('Admin.order.shipped');
    }
    // out of Delivery
    public function outOfDeliveryOrders(OutOfDeliveredOrderDataTable $dataTable)
    {

        return $dataTable->render('Admin.order.outofdelivery');
    }
    // Delivered order

    public function deliveredOrders(DeliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('Admin.order.delivered');
    }
    // Cancled order
    public function canceledOrders(CanceledOrderDataTable $dataTable)
    {

        return $dataTable->render('Admin.order.cancel');
    }
}
