@php
    $productSliderSectionThree = json_decode($productSliderSectionThree->value, true);
    // dd($productSliderSectionThree);
@endphp

<div class="tab-pane fade" id="list-slider-three" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.product-slider-section-three') }}" method="POST">
                @csrf
                @method('PUT')
                <h5>Part 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_one" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option
                                        {{ $category->id == $productSliderSectionThree[0]['category'] ? 'Selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories = \App\Models\SubCategory::where(
                                    'category_id',
                                    $productSliderSectionThree[0]['category'],
                                )->get();
                            @endphp
                            <label>Sub Category</label>
                            <select name="sub_cat_one" class="form-control sub-category">
                                <option value="">Select</option>
                                @foreach ($subCategories as $subCategory)
                                    <option
                                        {{ $subCategory->id == $productSliderSectionThree[0]['sub_category'] ? 'Selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $productSliderSectionThree[0]['sub_category'],
                                )->get();
                            @endphp
                            <label>Child Category</label>
                            <select name="child_cat_one" class="form-control child-category">
                                <option value="">Select</option>
                                @foreach ($childCategories as $childCategory)
                                    <option
                                        {{ $childCategory->id == $productSliderSectionThree[0]['child_category'] ? 'Selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <h5>Part 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_two" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option
                                        {{ $category->id == $productSliderSectionThree[1]['category'] ? 'Selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories = \App\Models\SubCategory::where(
                                    'category_id',
                                    $productSliderSectionThree[1]['category'],
                                )->get();
                            @endphp
                            <label>Sub Category</label>
                            <select name="sub_cat_two" class="form-control sub-category">
                                <option value="">Select</option>
                                @foreach ($subCategories as $subCategory)
                                    <option
                                        {{ $subCategory->id == $productSliderSectionThree[1]['sub_category'] ? 'Selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $productSliderSectionThree[1]['sub_category'],
                                )->get();
                            @endphp
                            <label>Child Category</label>
                            <select name="child_cat_two" class="form-control child-category">
                                <option value="">Select</option>
                                @foreach ($childCategories as $childCategory)
                                    <option
                                        {{ $childCategory->id == $productSliderSectionThree[1]['child_category'] ? 'Selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function() {
                // alert('Hello');
                let id = $(this).val();
                let row = $(this).closest('.row');
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategory') }}",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // console.log(data);
                        let selector = row.find('.sub-category');
                        selector.html(` <option value="">Select</option>`)
                        $.each(data, function(i, item) {
                            selector.append(
                                ` <option value="${item.id}">${item.name}</option>`)
                        })

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })


            // chenge child category
            $('body').on('change', '.sub-category', function() {
                // alert('Hello');
                let id = $(this).val();
                let row = $(this).closest('.row');
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.child-categories') }}",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // console.log(data);
                        let selector = row.find('.child-category');
                        selector.html(` <option value="">Select</option>`)
                        $.each(data, function(i, item) {
                            selector.append(
                                ` <option value="${item.id}">${item.name}</option>`)
                        })

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
