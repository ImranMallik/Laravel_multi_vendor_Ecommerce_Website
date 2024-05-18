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
                                                <h6>{{ $settings->currency_icon . $items->price }}</h6>
                                            </td>
                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $items->rowId }}">
                                                    {{ $settings->currency_icon . ($items->price + $items->options->variants_total) * $items->qty }}
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
                        <p>subtotal: <span id="sub_total">{{ $settings->currency_icon }}{{ getCartTotal() }}</span></p>

                        <p>discount: <span id="cart_discount">{{ $settings->currency_icon }}{{ getCartDiscount() }}</span>
                        </p>
                        <p class="total"><span>total:</span> <span
                                id="cart_sub_total">{{ $settings->currency_icon }}{{ getMainCartTotal() }}</span></p>

                        <form id="coupon_form">
                            <input type="text" placeholder="Coupon Code" name="coupon_code"
                                value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{ route('user.checkout') }}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                class="fab fa-shopify"></i>Keep Shopping</a>
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

            // {{-- Qty increment  --}}
            $('.product-increment').on('click', function() {
                // alert('hello');
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');

                // if (quantity > 10) {
                //     quantity = 10;
                //     toastr.warning('Maximum quantity per product is 10!');
                // }
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
                            renderCartSubtotal();
                            calculateCouponDescount();
                            toastr.success(data.message);
                        } else if (data.status === 'error') {
                            toastr.error(data.message)
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
                            renderCartSubtotal();
                            calculateCouponDescount();
                            toastr.success(data.message);
                        } else if (data.status === 'error') {
                            toastr.error(data.message)
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


            // get renderSubtotal

            function renderCartSubtotal() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart.sidebar-product-total') }}",
                    success: function(data) {
                        $('#sub_total').text("{{ $settings->currency_icon }}" + data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            }
            //Apply Coupon

            $('#coupon_form').on('submit', function(e) {
                e.preventDefault();
                let formdata = $(this).serialize();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('apply-coupon') }}",
                    data: formdata,
                    success: function(data) {
                        if (data.status === 'error') {
                            toastr.error(data.message);
                        } else if (data.status === 'success') {
                            calculateCouponDescount();
                            toastr.success(data.message);
                        }
                    },

                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            // calculat Chack Out page All Discount

            function calculateCouponDescount() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('calculate-discount-cupon') }}",
                    success: function(data) {
                        // $('#sub_total').text("{{ $settings->currency_icon }}" + data);
                        // console.log(data);
                        if (data.status === 'success') {

                            $('#cart_discount').text('{{ $settings->currency_icon }}' + data.discound);
                            $('#cart_sub_total').text('{{ $settings->currency_icon }}' + data
                                .cart_total);
                        }

                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            }

        })
    </script>
@endpush
