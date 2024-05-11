@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Cart Details
@endsection
@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>
                                        <th class="wsus__pro_tk">
                                            Unit price
                                        </th>
                                        <th class="wsus__pro_tk">
                                            price
                                        </th>


                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>



                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_all_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItem as $items)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset($items->options->image) }}"
                                                    alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{!! $items->name !!}</p>
                                                @foreach ($items->options->variants as $key => $variant)
                                                    <span>{{ $key }}: {{ $variant['name'] }}
                                                        ({{ $settings->currency_icon . $variant['price'] }})
                                                    </span>
                                                @endforeach
                                            </td>


                                            <td class="wsus__pro_tk">
                                                <h6>
                                                    {{ $settings->currency_icon . $items->price + $items->options->variants_total }}
                                                </h6>
                                            </td>
                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $items->rowId }}">{{ $settings->currency_icon . $items->price }}
                                                </h6>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <div class="product_qty_wrapper">
                                                    <button class="btn btn-danger product-decrement mx-1">-</button>
                                                    <input class="product-qty" data-rowid="{{ $items->rowId }}"
                                                        type="text" min="1" max="100"
                                                        value="{{ $items->qty }}" readonly />
                                                    <button class="btn btn-success product-increment mx-1">+</button>
                                                </div>
                                            </td>



                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('clear-singel-item', $items->rowId) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($cartItem) === 0)
                                        <div class="d-flex">
                                            <td class="wsus__pro_icon" rowspan="2" style="width: 100%">
                                                Cart is empty!
                                            </td>
                                        </div>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>

                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                class="fab fa-shopify"></i> go shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
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

            // {{-- Qty increment or decrement --}}
            $('.product-increment').on('click', function() {
                // alert('hello');
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');

                if (quantity > 10) {
                    quantity = 10;
                    toastr.warning('Maximum quantity per product is 10!');
                }
                input.val(quantity);

                $.ajax({
                    url: "{{ route('update-qty') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .product_total;
                            $(productId).text(totalAmount);
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {

                    }
                })
            })
            // Decrement Btn Ajax---
            $('.product-decrement').on('click', function() {
                // alert('hello');
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');
                if (quantity < 1) {
                    quantity = 1;
                    toastr.warning('Minimum quantity per product is 1!');
                }
                input.val(quantity);


                $.ajax({
                    url: "{{ route('update-qty') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .product_total;
                            $(productId).text(totalAmount);
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {

                    }
                })
            })

            // Clear All cart item----__

            $('.clear_all_cart').on('click', function(e) {
                e.preventDefault();
                // alert('Ok');
                Swal.fire({
                    title: "Are you sure?",
                    text: "This Action Will Clear Your Cart!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Ajax delete
                        $.ajax({
                            type: 'get',
                            url: "{{ route('clear-all-cart') }}",

                            success: function(data) {
                                if (data.status === 'success') {
                                    toastr.success(data.message);
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });

                    }
                });
            })
        })
    </script>
@endpush
