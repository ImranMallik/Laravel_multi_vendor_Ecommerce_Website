@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Checkout
@endsection
@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>check out</h4>
                        <ul>
                            <li><a href="{{ route('user.index') }}">home</a></li>
                            <li><a href="javascript:;">check out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__cart_view">
        <div class="container">

            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <h5 class="d-flex justify-content-between align-items-center">Shipping Details <a
                                class="btn btn-outline-primary " href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">add
                                new address</a></h5>
                        {{-- <h5>Billing Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                new address</a></h5> --}}

                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" data-id="{{ $address->id }}"
                                                type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span>{{ $address->name }}</li>
                                            <li><span>Phone :</span> +{{ $address->phone }}</li>
                                            <li><span>Email :</span>{{ $address->email }}</li>
                                            <li><span>Country :</span>{{ $address->country }}</li>
                                            <li><span>City :</span>{{ $address->city }}</li>
                                            <li><span>Zip Code :</span>{{ $address->zip }}</li>
                                            <li><span>Address :</span>{{ $address->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">shipping Methods</p>
                        @foreach ($shippingRoule as $roule)
                            @if ($roule->type === 'min_cost' && getCartTotal() >= $roule->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $roule->id }}" data-id= "{{ $roule->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $roule->name }}
                                        <span>cost: ({{ $settings->currency_icon }}{{ $roule->cost }})</span>
                                    </label>
                                </div>
                            @elseif ($roule->type === 'flat_cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $roule->id }}" data-id= "{{ $roule->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $roule->name }}
                                        <span>cost: ({{ $settings->currency_icon }}{{ $roule->cost }})</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach

                        <div class="wsus__order_details_summery">
                            <p>subtotal: <span>{{ $settings->currency_icon }}{{ getCartTotal() }}</span></p>
                            <p>shipping fee(+): <span id="shipping_fee">{{ $settings->currency_icon }}0</span></p>
                            <p>Coupon(-): <span>{{ $settings->currency_icon }}{{ getCartDiscount() }}</span></p>
                            <p><b>total:</b>
                                <span><b id="total_amount"
                                        data-id="{{ getMainCartTotal() }}">{{ $settings->currency_icon }}{{ getMainCartTotal() }}</b></span>
                            </p>
                        </div>
                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input agree-icon" type="checkbox" value=""
                                    id="flexCheckChecked3" checked>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    I have read and agree to the website <a href="#">terms and conditions *</a>
                                </label>
                            </div>
                            <form action="" id="checkOutForm">
                                <input type="hidden" name="shipping_method_id" id="shipping_method_id" value="">
                                <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="">
                            </form>
                        </div>
                        <a href="" id="submitCheckoutForm" class="common_btn">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{ route('user.create.checout') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="phone" value="{{ old('phone') }}"
                                                placeholder="Phone *">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                placeholder="Email *">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <select class="select_2" name="country">
                                                <option value="AL">Country / Region *</option>
                                                @foreach (config('settings.country_list') as $key => $country)
                                                    <option {{ $country === old('country') ? 'selected' : '' }}
                                                        value="{{ $country }}">{{ $country }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="state" value="{{ old('state') }}"
                                                placeholder="Street Address *">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="city" value="{{ old('city') }}"
                                                placeholder="Town / City *">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="state" value="{{ old('state') }}"
                                                placeholder="State *">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="zip" value="{{ old('zip') }}"
                                                placeholder="Zip *">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="address" value="{{ old('address') }}"
                                                placeholder="Address*">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('input[type="radio"]').prop('checked', false);
            $('#shipping_address_id').val('');
            $('#shipping_method_id').val();
            $('.shipping_method').on('click', function() {
                // alert($(this).val());
                let shippingFee = $(this).data('id');
                let currentTotalAmount = $('#total_amount').data('id');
                let totalAmount = currentTotalAmount + shippingFee;
                $('#shipping_method_id').val($(this).val());
                $('#shipping_fee').text("{{ $settings->currency_icon }}" + shippingFee);
                $('#total_amount').text("{{ $settings->currency_icon }}" + totalAmount);


            })
            $('.shipping_address').on('click', function() {
                // alert('hi');
                $('#shipping_address_id').val($(this).data('id'));
            })


            // place Order Form Submit
            $('#submitCheckoutForm').on('click', function(e) {
                e.preventDefault();
                // validation
                if ($('#shipping_address_id').val() == "") {
                    toastr.error('Shipping address is requred');
                } else if ($('#shipping_method_id').val() == "") {
                    toastr.error('Shipping method is requred');

                } else if (!$('.agree-icon').prop('checked')) {
                    toastr.error('You have to agree website terms and conditions');
                } else {


                    $.ajax({
                        method: 'POST',
                        url: "{{ route('user.checout.formsubmit') }}",
                        data: $('#checkOutForm').serialize(),
                        beforeSend: function() {
                            $('#submitCheckoutForm').html(
                                '<i class="fas fa-spinner fa-spin fa-1x"></i>');
                        },
                        success: function(data) {
                            if (data.status === 'success') {

                                $('#submitCheckoutForm').html(
                                    'Place Order');

                                window.location.href = data.redirect_url;
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    })
                }

            })
        })
    </script>
@endpush
