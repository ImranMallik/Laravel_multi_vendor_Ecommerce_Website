  <header>
      <div class="container">
          <div class="row">
              <div class="col-2 col-md-1 d-lg-none">
                  <div class="wsus__mobile_menu_area">
                      <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                  </div>
              </div>
              <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                  <div class="wsus_logo_area">
                      <a class="wsus__header_logo" href="{{ route('user.index') }}">
                          <img src="{{ asset('frontend/images/logo.png') }}" alt="logo" class="img-fluid w-100">
                      </a>
                  </div>
              </div>
              <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                  <div class="wsus__search">
                      <form action="{{ route('product.index') }}">
                          <input type="text" placeholder="Search..." name="search" value="{{ request()->search }}">
                          <button type="submit"><i class="far fa-search"></i></button>
                      </form>
                  </div>
              </div>
              <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                  <div class="wsus__call_icon_area">
                      <div class="wsus__call_area">
                          <div class="wsus__call">
                              <i class="fas fa-user-headset"></i>
                          </div>
                          <div class="wsus__call_text">
                              <p>example@gmail.com</p>
                              <p>+569875544220</p>
                          </div>
                      </div>
                      <ul class="wsus__icon_area">
                          <li><a href="wishlist.html"><i class="fal fa-heart"></i><span>05</span></a></li>
                          <li><a href="compare.html"><i class="fal fa-random"></i><span>03</span></a></li>
                          <li><a class="wsus__cart_icon" href="#"><i class="fal fa-shopping-bag"></i><span
                                      id="Cart_count">{{ Cart::content()->count() }}</span></a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="wsus__mini_cart">
          <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
          <ul class="mini_cart_wrapper">
              {{-- <li>
                  <div class="wsus__cart_img">
                      <a href="#"><img src="images/tab_2.jpg" alt="product" class="img-fluid w-100"></a>
                      <a class="wsis__del_icon" href="#"><i class="fas fa-minus-circle"></i></a>
                  </div>
                  <div class="wsus__cart_text">
                      <a class="wsus__cart_title" href="#">apple 9.5" 7 serise tab with full view display</a>
                      <p>$140 <del>$150</del></p>
                  </div>
              </li> --}}
              @foreach (Cart::content() as $sideparProduct)
                  <li id="mini_cart_{{ $sideparProduct->rowId }}">
                      <div class="wsus__cart_img">
                          <a href="#"><img src="{{ asset($sideparProduct->options->image) }}" alt="product"
                                  class="img-fluid w-100"></a>
                          <a class="wsis__del_icon remove_sidebar_product" data-id="{{ $sideparProduct->rowId }}"
                              href="#"><i class="fas fa-minus-circle"></i></a>
                      </div>
                      <div class="wsus__cart_text">
                          <a class="wsus__cart_title"
                              href="{{ route('product-details', $sideparProduct->options->slug) }}">{{ $sideparProduct->name }}</a>
                          <p>{{ $settings->currency_icon }} {{ $sideparProduct->price }}</p>
                          <small>Variants total:
                              {{ $settings->currency_icon }}{{ $sideparProduct->options->variants_total }}</small>
                          <br>
                          <small>Qty: {{ $sideparProduct->qty }}</small>
                      </div>
                  </li>
              @endforeach

              @if (Cart::content()->count() === 0)
                  <li class="text-center">Cart Is Empty!</li>
              @endif

          </ul>
          {{-- @php
              $total = ($sideparProduct->price + $sideparProduct->options->variants_total) * $sideparProduct->qty;
              print_r($total);
          @endphp --}}
          <div class="mini_cart_checkout {{ Cart::content()->count() === 0 ? 'd-none' : ' ' }}">
              <h5>sub total <span id="mini_cart_price">{{ $settings->currency_icon }}{{ getCartTotal() }}</span>
              </h5>
              <div class="wsus__minicart_btn_area">
                  <a class="common_btn" href="{{ route('cart-details') }}">view cart</a>
                  <a class="common_btn" href="{{ route('user.checkout') }}">checkout</a>
              </div>

          </div>
      </div>

  </header>
