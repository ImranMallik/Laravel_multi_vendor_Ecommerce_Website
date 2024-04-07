@extends('Admin.layout.master')

@section('section')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant</h1>

        </div>
        <div class="mb-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Product Variant</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('admin.products-variant.update', $product->id)}}">

                                @csrf
                                @method('PUT')
                              
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $product->name }}" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control form-control-lg">
                                        <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
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
