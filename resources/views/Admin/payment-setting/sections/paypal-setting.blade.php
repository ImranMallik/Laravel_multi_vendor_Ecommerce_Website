<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.paypal-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Paypal Status</label>
                    <select name="status" class="form-control">
                        <option {{ $PaypalSetting->status === 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $PaypalSetting->status === 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="mode" class="form-control">
                        <option {{ $PaypalSetting->mode === 1 ? 'selected' : '' }} value="1">SandBox</option>
                        <option {{ $PaypalSetting->mode === 0 ? 'selected' : '' }} value="0">Live</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country" id="" class="form-control select2">
                        <option>Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $country === $PaypalSetting->country ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency" id="" class="form-control select2">
                        <option>Select</option>
                        @foreach (config('settings.currenct_list') as $key => $currency)
                            <option {{ $currency === $PaypalSetting->currency ? 'selected' : '' }}
                                value="{{ $currency }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency rate (Per USD)</label>
                    <input type="text" value="{{ $PaypalSetting->currency_rate }}" class="form-control"
                        name="currency_rate" value="">
                </div>
                <div class="form-group">
                    <label>Paypal Client Id</label>
                    <input type="text" class="form-control" value="{{ $PaypalSetting->client_id }}" name="client_id"
                        value="">
                </div>
                <div class="form-group">
                    <label>Paypal Secret Key</label>
                    <input type="text" class="form-control" value="{{ $PaypalSetting->secret_key }}"
                        name="secret_key">
                </div>


                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
