<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{ asset('frontend/images/flash_sell_bg.jpg') }});">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sell</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{ route('flash-sale') }}">see more <i
                                class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($flashSaleItem as $items)
                @php
                    $product = \App\Models\Product::find($items->product_id);
                @endphp
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">{{ productType($product->product_type) }}</span>
                        @if (checkDiscount($product))
                            <span
                                class="wsus__minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}%</span>
                        @endif
                        <a class="wsus__pro_link" href="{{ route('product-details', $product->slug) }}">
                            <img src="{{ asset($product->thumb_image) }}" alt="product"
                                class="img-fluid w-100 img_1" />
                            <img src="@if (isset($product->productImageGallery[0]->image)) {{ asset($product->productImageGallery[0]->image) }}
                        @else
                            {{ asset($product->thumb_image) }} @endif"
                                alt="product" class="img-fluid w-100 img_2" />

                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal-{{ $product->id }}"><i class="far fa-eye"></i></a>
                            </li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{ $product->category->name }}</a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name"
                                href="{{ route('product-details', $product->slug) }}">{{ $product->name }}</a>
                            @if (checkDiscount($product))
                                <p class="wsus__price">
                                    {{ $settings->currency_icon }}{{ $product->offer_price }}<del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                </p>
                            @else
                                <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->price }}</p>
                            @endif
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>

<!--==========================
                          PRODUCT MODAL VIEW START
===========================-->
@foreach ($flashSaleItem as $items)
    @php
        $product = \App\Models\Product::find($items->product_id);
    @endphp
    <section class="product_popup_modal">
        <div class="modal fade" id="exampleModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="far fa-times"></i></button>
                        <div class="row">
                            <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                <div class="wsus__quick_view_img">
                                    {{-- @if ($product->video_link)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                    @endif --}}
                                    <div class="row modal_slider">
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                    class="img-fluid w-100">
                                            </div>
                                        </div>

                                        @if (count($product->productImageGallery) === 0)
                                            {
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>
                                            }
                                        @endif

                                        @foreach ($product->productImageGallery as $Image)
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($Image->image) }}" alt="{{ $product->name }}"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="wsus__pro_details_text">
                                    <a class="title" href="#">{{ $product->name }}</a>
                                    <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>
                                    @if (checkDiscount($product))
                                        <h4>{{ $settings->currency_icon }}{{ $product->offer_price }}<del>${{ $product->price }}</del>
                                        </h4>
                                    @else
                                        <h4>{{ $settings->currency_icon }}{{ $product->price }}</h4>
                                    @endif
                                    <p class="review">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>20 review</span>
                                    </p>
                                    <p class="description">{!! $product->short_description !!}</p>

                                    <div class="wsus__selectbox">
                                        <div class="row">

                                            @foreach ($product->ProductVariat as $item)
                                                <div class="col-xl-6 col-sm-6">
                                                    <h5 class="mb-2">{{ $item->name }}:</h5>
                                                    <select class="select_2" name="state">
                                                        @foreach ($item->ProductVariantItem as $variantItem)
                                                            <option
                                                                {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                                {{ $variantItem->name }}
                                                                ({{ $settings->currency_icon }}{{ $variantItem->price }})
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>


                                    <div class="wsus__quentity">
                                        <h5>quentity :</h5>
                                        <form class="select_number">
                                            <input class="number_area" type="text" min="1" max="100"
                                                value="1" />
                                        </form>
                                    </div>

                                    <ul class="wsus__button_area">
                                        <li><a class="add_cart" href="#">add to cart</a></li>
                                        <li><a class="buy_now" href="#">buy now</a></li>
                                        <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                        <li><a href="#"><i class="far fa-random"></i></a></li>
                                    </ul>
                                    <p class="brand_model"><span>brand :</span>{{ $product->Brand->name }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
<!--==========================
                      PRODUCT MODAL VIEW END
===========================-->

@push('scripts')
    <script>
        $(document).ready(function() {
            var d = new Date(),
                countUpDate = new Date();
            d.setDate(d.getDate() + 90);
            // alert(d.getFullYear());
            simplyCountdown(".simply-countdown-one", {
                year: {{ date('Y', strtotime($flashSaleDate->end_date)) }},
                month: {{ date('m', strtotime($flashSaleDate->end_date)) }},
                day: {{ date('d', strtotime($flashSaleDate->end_date)) }},
            });
        })
    </script>
@endpush
