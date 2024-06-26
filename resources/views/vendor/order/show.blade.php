@php
    $address = json_decode($order->order_address);
@endphp
@extends('vendor.layouts.master')
@section('title')
    {{ $settings->site_name }} || Orders Show
@endsection
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fab fa-shopify"></i> Order Details</h3>

                        <div class="wsus__dashboard_profile">

                            <section id="" class="invoice-print">
                                <div class="">
                                    <div class="wsus__invoice_area">
                                        <div class="wsus__invoice_header">
                                            <div class="wsus__invoice_content">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single">
                                                            <h5>Billing Information</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }},{{ $address->city }},{{ $address->state }},{{ $address->zip }}
                                                            </p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single text-md-center">
                                                            <h5>shipping information</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }},{{ $address->city }},{{ $address->state }},{{ $address->zip }}
                                                            </p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="wsus__invoice_single text-md-end">
                                                            <h5>Order id:#{{ $order->invocie_id }}</h5>
                                                            <h6>Order
                                                                Status:{{ config('order_status.order_status_admin')[$order->order_status]['status'] }}
                                                            </h6>
                                                            <p>Payment Method:{{ $order->payment_method }}</p>
                                                            <p>{{ $order->order_status }}</p>
                                                            <p>Transaction id:
                                                                {{ $order->transaction->transaction_id }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wsus__invoice_description">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th class="name">
                                                                product
                                                            </th>
                                                            <th class="vendor">
                                                                Vendor
                                                            </th>

                                                            <th class="amount">
                                                                amount
                                                            </th>

                                                            <th class="quentity">
                                                                quentity
                                                            </th>
                                                            <th class="total">
                                                                total
                                                            </th>
                                                        </tr>
                                                        @foreach ($order->OrderProduct as $product)
                                                            @if ($product->vendor_id === Auth::user()->vendorprofile->id)
                                                                @php
                                                                    $variants = json_decode($product->variants);
                                                                @endphp
                                                                <tr>
                                                                    <td class="name">
                                                                        <p>{{ $product->product_name }}</p>
                                                                        @foreach ($variants as $key => $item)
                                                                            <span>{{ $key }} :
                                                                                {{ $item->name }}({{ $settings->currency_icon }}{{ $item->price }})
                                                                            </span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td class="vendor">
                                                                        {{ $product->vendor->shope_name }}
                                                                    </td>
                                                                    <td class="amount">
                                                                        {{ $settings->currency_icon }}
                                                                        {{ $product->unit_price }}
                                                                    </td>

                                                                    <td class="quentity">
                                                                        {{ $product->qty }}
                                                                    </td>
                                                                    <td class="total">
                                                                        {{ $settings->currency_icon }}
                                                                        {{ $product->qty * $product->unit_price }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_footer">
                                            <p><span>Total Amount:</span>{{ $settings->currency_icon }}
                                                {{ $product->qty * $product->unit_price }} </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="">
                                        <div class="form-group mt-5">
                                            <label for="">Order Status:</label>
                                            <select data-id="{{ $order->id }}" name="order_status" id="order_status"
                                                class="form-control">
                                                @foreach (config('order_status.order_status_vendor') as $key => $status)
                                                    <option {{ $key === $order->order_status ? 'Selected' : '' }}
                                                        value="{{ $key }}">
                                                        {{ $status['status'] }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                                        </div>

                                    </form>

                                </div>

                                <div class="col-md-8">
                                    <div class="mt-5 float-end">
                                        <button class="btn btn-warning btn-icon icon-left print_invoice  "><i
                                                class="fas fa-print"></i>
                                            Print</button>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#order_status').on('change', function() {
                let status_val = $(this).val();
                let id = $(this).data('id');
                // alert(id)
                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.orders.status-change') }}",
                    data: {
                        status: status_val,
                        id: id
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data.status === 'success') {
                            toastr.success(data.message)
                        }
                    },
                });
            });



            // Print Order page

            $('.print_invoice').on('click', function() {
                // alert('hi');
                let printBody = $('.invoice-print');
                let originalContent = $('body').html();

                $('body').html(printBody.html());
                window.print();
                $('body').html(originalContent);
            })
        });
    </script>
@endpush
