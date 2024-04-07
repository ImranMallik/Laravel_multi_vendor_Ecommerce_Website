@extends('Admin.layout.master')

@section('section')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Item</h1>
           
        </div>
        <div class="mb-3">
            <a href="{{ route('admin.products-variant.index',['product'=>$product->id])}}" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product:</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.product-variant-item.create',['productId' => $product->id,'variantId'=>$variant->id]) }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    @endsection
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
       
    @endpush
