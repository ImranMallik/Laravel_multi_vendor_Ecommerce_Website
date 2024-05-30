@php
    $address = json_decode($order->order_address);
    // dd($address);
    $shipping_method = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp


@extends('Admin.layout.master')

@section('section')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>

        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #{{ $order->invocie_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <b>Name:</b> {{ $address->name }}<br>
                                        <b>Email:</b> {{ $address->email }}<br>
                                        <b>Phone:</b> {{ $address->phone }}<br>
                                        <b>Address:</b> {{ $address->address }},<br>
                                        {{ $address->city }},{{ $address->state }},{{ $address->zip }}<br>
                                        {{ $address->country }}<br>

                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <b>Name:</b> {{ $address->name }}<br>
                                        <b>Email:</b> {{ $address->email }}<br>
                                        <b>Phone:</b> {{ $address->phone }}<br>
                                        <b>Address:</b> {{ $address->address }},<br>
                                        {{ $address->city }},{{ $address->state }},{{ $address->zip }}<br>
                                        {{ $address->country }}<br>

                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Information:</strong><br>
                                        <b>Method:</b>{{ $order->payment_method }}<br>
                                        <b>Transaction Id:</b>{{ @$order->transaction->transaction_id }}<br>
                                        <b>Status:{{ $order->payment_status === 1 ? 'Complete' : 'Pending' }}</b>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{ date('d F, Y', strtotime($order->created_at)) }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th>Variant</th>
                                        <th>Vendor Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Totals</th>
                                    </tr>
                                    @foreach ($order->OrderProduct as $item)
                                        @php
                                            $variants = json_decode($item->variants);
                                            // dd($variants);
                                        @endphp
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            @if (isset($item->product->slug))
                                                <td><a target="_blank"
                                                        href="{{ route('product-details', $item->product->slug) }}">{{ $item->product_name }}</a>
                                                </td>
                                            @endif
                                            <td>
                                                @foreach ($variants as $key => $variant)
                                                    <b>{{ $key }}:</b>{{ $variant->name }}({{ $settings->currency_icon }}{{ $variant->price }})
                                                @endforeach
                                            </td>
                                            <td>{{ $item->vendor->shope_name }}</td>
                                            <td class="text-center">{{ $settings->currency_icon }}{{ $item->unit_price }}
                                            </td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td class="text-right">
                                                {{ $settings->currency_icon }}{{ ($item->unit_price + $item->variant_total) * $item->qty }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Payment Status</label>
                                            <select name="" data-id="{{ $order->id }}" class="form-control"
                                                id="payment_status">
                                                <option {{ $order->payment_status === 0 ? 'Selected' : '' }}
                                                    value="0">Pending</option>
                                                <option {{ $order->payment_status === 1 ? 'Selected' : '' }}
                                                    value="1">Completed</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Order Status:</label>
                                            <select data-id="{{ $order->id }}" name="order_status" class="form-control"
                                                id="order_status">
                                                @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                    <option {{ $order->order_status === $key ? 'Selected' : '' }}
                                                        value="{{ $key }}">{{ $orderStatus['status'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Subtotal</div>
                                        <div class="invoice-detail-value">
                                            {{ $settings->currency_icon }}{{ $order->sub_total }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Shipping (+)</div>
                                        <div class="invoice-detail-value">
                                            {{ $settings->currency_icon }}{{ @$shipping_method->cost }}</div>
                                    </div>
                                    @php
                                        $discount_val = $order->sub_total;
                                        $discal = ($discount_val * @$coupon->discount_value) / 100;
                                        $final_dis = $discount_val - $discal;
                                    @endphp
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Coupon (-)</div>
                                        @if ($coupon->discount_type === 'percent')
                                            <div class="invoice-detail-value">
                                                {{ @$coupon->discount_value ? @$coupon->discount_value . '%' : '0%' }}({{ $final_dis }})
                                            </div>
                                        @else
                                            <div class="invoice-detail-value">
                                                {{ $settings->currency_icon }}{{ @$coupon->discount_value ? @$coupon->discount_value : 0 }}
                                            </div>
                                        @endif
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{ $settings->currency_icon }}{{ $order->amount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                        {{-- <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process
                            Payment</button> --}}
                        <a href="{{ route('admin.order.index') }}" class="btn btn-danger btn-icon icon-left"><i
                                class="fas fa-times"></i> Cancel</a>

                    </div>
                    <button class="btn btn-warning btn-icon icon-left print_invoice  "><i class="fas fa-print"></i>
                        Print</button>
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
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order-status.change') }}",
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
            // Payment_Status Change Ajax
            $('#payment_status').on('change', function() {
                let status_val = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.payment-status.change') }}",
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
