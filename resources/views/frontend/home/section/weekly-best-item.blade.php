 @php
     $productSliderSectionThree = json_decode($productSliderSectionThree->value, true);
     //   dd($productSliderSectionThree);
 @endphp

 <section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
     <div class="container">
         <div class="row">
             @foreach ($productSliderSectionThree as $secthionThree)
                 @php
                     //  dd($secthionThree);
                     $lastkey = [];
                     foreach ($secthionThree as $key => $category) {
                         if ($category === null) {
                             break;
                         }

                         $lastkey = [$key => $category];
                     }

                     if (array_keys($lastkey)[0] === 'category') {
                         //   Call ChildCategory Model
                         $category = \App\Models\Category::find($lastkey['category']);
                         $products = \App\Models\Product::where('category_id', $category->id)
                             ->orderBy('id', 'DESC')
                             ->take(3)
                             ->get();
                     } elseif (array_keys($lastkey)[0] === 'sub_category') {
                         // Call SubCategory Model
                         $category = \App\Models\SubCategory::find($lastkey['sub_category']);
                         $products = \App\Models\Product::where('sub_category_id', $category->id)
                             ->orderBy('id', 'DESC')
                             ->take(3)
                             ->get();
                     } else {
                         // Call Child Category Model
                         $category = \App\Models\ChildCategory::find($lastkey['child_category']);
                         $products = \App\Models\Product::where('child_category_id', $category->id)
                             ->orderBy('id', 'DESC')
                             ->take(3)
                             ->get();
                     }
                     //  dd($category);
                 @endphp
                 <div class="col-xl-6 col-sm-6">
                     <div class="wsus__section_header">
                         <h3>{{ $category->name }}</h3>
                     </div>
                     <div class="row weekly_best2">
                         @foreach ($products as $product)
                             <div class="col-xl-4 col-lg-4">
                                 <a class="wsus__hot_deals__single" href="{{ route('product-details', $product->slug) }}">
                                     <div class="wsus__hot_deals__single_img">
                                         <img src="{{ asset($product->thumb_image) }}" alt="bag"
                                             class="img-fluid w-100">
                                     </div>
                                     <div class="wsus__hot_deals__single_text mt-2">
                                         <h5>{!! limitText($product->name) !!}</h5>
                                         <p class="wsus__rating">
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star"></i>
                                             <i class="fas fa-star-half-alt"></i>
                                         </p>


                                         @if (checkDiscount($product))
                                             <p class="wsus__tk">
                                                 {{ $settings->currency_icon }}{{ $product->offer_price }}
                                                 <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                             </p>
                                         @else
                                             <p class="wsus__tk">{{ $settings->currency_icon }}{{ $product->price }}</p>
                                         @endif
                                     </div>
                                 </a>
                             </div>
                         @endforeach
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
