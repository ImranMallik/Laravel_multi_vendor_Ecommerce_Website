@extends('Admin.layout.master')

@section('section')
    <section class="section">
        <div class="section-header">
            <h1>Coupon</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Coupon</h4>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $coupon->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code" value="{{ $coupon->code }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" value="{{ $coupon->quantity }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Max Use Per Person</label>
                                    <input type="text" name="max_use" value="{{ $coupon->max_use }}"
                                        class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="text" value="{{ $coupon->start_date }}" name="start_date"
                                                class="form-control datepicker">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="text" value="{{ $coupon->end_date }}" name="end_date"
                                                class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discount_type">Discount Type</label>
                                            <select name="discount_type" id="discount_type" class="form-control">
                                                <option {{ $coupon->discount_type == 'percent' ? 'selected' : '' }}
                                                    value="percent">Percentage (%)
                                                </option>
                                                <option {{ $coupon->discount_type == 'amount' ? 'selected' : '' }}
                                                    value="amount">Amount
                                                    ({{ $settings->currency_icon }})</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Descount Value</label>
                                            <input type="text" value="{{ $coupon->descount_value }}"
                                                class="form-control" name="descount_value">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $coupon->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $coupon->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
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
@endpush
