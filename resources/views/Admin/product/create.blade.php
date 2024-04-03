@extends('Admin.layout.master')

@section('section')
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Category</label>
                                            <select id="status" name="category"
                                                class="form-control form-control-lg main-category">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Sub Category</label>
                                            <select id="status" name="sub_category"
                                                class="form-control form-control-lg sub-category">
                                                <option>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Child Category</label>
                                            <select id="status" name="child_category"
                                                class="form-control form-control-lg child-category">
                                                <option>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Brand</label>
                                    <select id="status" name="brand" class="form-control form-control-lg">
                                        <option value="">Select</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Sku</label>
                                    <input type="text" class="form-control" name="sku" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Offer Price</label>
                                    <input type="text" class="form-control" name="offer_price"
                                        value="{{ old('offer_price') }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Offer Start Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_start"
                                                value="{{ old('offer_start') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Offer End Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_end"
                                                value="{{ old('offer_end') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Stock Quantity</label>
                                    <input type="number" min="0" class="form-control" name="qty"
                                        value="{{ old('qty') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Video Link</label>
                                    <input type="text" class="form-control" name="video_link"
                                        value="{{ old('video_link') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Short Description</label>
                                    <textarea name="short_description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status">Long Description</label>
                                    <textarea name="long_description" class="form-control summernote"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Is Top</label>
                                            <select id="status" name="is_top" class="form-control form-control-lg">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Is Best</label>
                                            <select id="status" name="is_best" class="form-control form-control-lg">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Is Featured</label>
                                            <select id="status" name="is_featured"
                                                class="form-control form-control-lg">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Seo Title</label>
                                    <input type="text" class="form-control" name="seo_title"
                                        value="{{ old('seo_title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Seo Description</label>
                                    <textarea name="seo_description" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control form-control-lg">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Get Main Category Ajax---
        $(document).ready(function() {
            $('body').on('change', '.main-category', function() {
                // alert('Hello');
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-subcategories') }}",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.sub-category').html(` <option value="">Select</option>`)
                        $.each(data, function(i, item) {
                            $('.sub-category').append(
                                ` <option value="${item.id}">${item.name}</option>`)
                        })

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })

        // Get Child Category Ajax--
        $(document).ready(function() {
            $('body').on('change', '.sub-category', function() {
                // alert('Hello');
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.child-categories') }}",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.child-category').html(` <option value="">Select</option>`)
                        $.each(data, function(i, item) {
                            $('.child-category').append(
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
