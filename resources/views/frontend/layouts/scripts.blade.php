<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Add  Cart Item -------_____
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            // console.log(formData);

            $.ajax({
                method: 'POST',
                data: formData,
                url: "{{ route('add-to-cart') }}",
                success: function(data) {
                    getCartCount();
                    fetchSidebarCartProducts();
                    $('.mini_cart_checkout').removeClass('d-none');
                    toastr.success(data.message);
                },
                error: function(data) {

                }
            })
        })

        // Count Cart Item In Cart Icont On Header------______

        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('count-cart-item') }}",
                success: function(data) {
                    $('#Cart_count').text(data);
                },
                error: function(data) {

                }
            })
        }

        // Add Product mini cart icon (bag on  header)

        function fetchSidebarCartProducts() {
            $.ajax({
                method: 'GET',
                url: "{{ route('add-mini-cart') }}",
                success: function(data) {
                    // console.log(data);
                    let html = '';
                    $('.mini_cart_wrapper').html("");
                    for (let item in data) {
                        let product = data[item];
                        html += `<li id="mini_cart_${product.rowId}">
                       <div class="wsus__cart_img">
                      <a href="#"><img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                      <a class="wsis__del_icon remove_sidebar_product" data-id = "${product.rowId}" href="{{ url('product-detail/') }}${product.options.slug}"><i class="fas fa-minus-circle"></i></a>
                      </div>
                      <div class="wsus__cart_text">
                      <a class="wsus__cart_title" href="#">${product.name}</a>
                      <p>{{ $settings->currency_icon }}${product.price}</p>
                      <small>Variants total:
                              {{ $settings->currency_icon }}${product.options.variants_total}</small>
                          <br>
                          <small>Qty:${product.qty}</small>
                      </div>
                      </li>`
                    }
                    $('.mini_cart_wrapper').html(html);

                    getSidebarCartTotal();
                },
                error: function(data) {

                }
            })
        }
        //  Product delet cart icon---___
        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault();
            let rowId = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: "{{ route('cart.remove-sidebar-product') }}",
                data: {
                    rowId: rowId
                },
                success: function(data) {
                    // console.log(data);
                    let productId = '#mini_cart_' + rowId;
                    $(productId).remove();
                    getSidebarCartTotal();
                    if ($('.mini_cart_wrapper').find('li').length === 0) {
                        $('.mini_cart_checkout').addClass('d-none');
                        $('.mini_cart_wrapper').html(
                            '<li class ="text-center">Cart Is Empty!</li>')
                    }
                    toastr.success(data.message);
                },
                error: function(data) {

                }
            })
        })

        //  Mini Product Price in cart icon -----___

        function getSidebarCartTotal() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#mini_cart_price').text("{{ $settings->currency_icon }}" + data);
                },
                error: function(data) {

                }
            })
        }
    })
</script>
