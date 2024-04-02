@extends('Admin.layout.master')

@section('section')
    <section class="section">
        <div class="section-header">
            <h1>Child Category</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Child Categories</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.child-category.update', $childCategory->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="status">Category</label>
                                    <select id="status" name="category"
                                        class="form-control form-control-lg main-category">
                                        <option value="">Select</option>
                                        @foreach ($category as $value)
                                            <option {{ $value->id == $childCategory->category_id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Sub Category</label>
                                    <select id="status" name="subcategory"
                                        class="form-control form-control-lg sub-category">
                                        <option value="">Select</option>
                                        @foreach ($subcategory as $value)
                                            <option {{ $value->id == $childCategory->sub_category_id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $childCategory->name }}" name="name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control form-control-lg">
                                        <option {{ $value->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $value->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
        $(document).ready(function() {
            $('body').on('change', '.main-category', function() {
                // alert('Hello');
                let id = $(this).val();
                // console.log(id);
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategory') }}",
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
    </script>
@endpush
