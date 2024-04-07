@extends('Admin.layout.master')

@section('section')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Item</h1>

        </div>
      

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update  Variant Item</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.product-variant-item.update',$variantItem->id) }}">
                                @csrf
                                @method('PUT')
                              
                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" name="variant_name" value="{{ $variantItem->ProductVariant->name }}" class="form-control" readonly>
                                </div>
                                {{-- <div class="form-group">
                                    <input type="hidden" name="variant_id" value="{{  $productVariant->id }}" class="form-control">
                                </div> --}}
                                {{-- <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                                </div> --}}
                              
                                <div class="form-group">
                                    <label>Price <code>(set 0 for make it free)</code></label>
                                    <input type="text" name="price" value="{{ $variantItem->price }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" name="name" value="{{ $variantItem->name }}" class="form-control">
                                </div>
                              
                                <div class="form-group">
                                    <label for="status">Is Default</label>
                                    <select id="status" name="is_default" class="form-control form-control-lg">
                                        <option value="">Select</option>
                                        <option {{ $variantItem->is_default == 1 ? 'selected' : '' }} value="1">Yes</option>
                                        <option {{ $variantItem->is_default == 0 ? 'selected' : '' }} value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control form-control-lg">
                                        <option {{ $variantItem->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $variantItem->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
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
