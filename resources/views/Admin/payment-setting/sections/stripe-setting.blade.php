<div class="tab-pane fade" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.stripe-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Stripe Status</label>
                    <select name="status" class="form-control">
                        <option {{ $StripeSetting->status === 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ $StripeSetting->status === 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="mode" class="form-control">
                        <option {{ $StripeSetting->mode === 1 ? 'selected' : '' }} value="1">SandBox</option>
                        <option {{ $StripeSetting->mode === 0 ? 'selected' : '' }} value="0">Live</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country" class="form-control select2">
                        <option>Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $country === $StripeSetting->country ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency" id="" class="form-control select2">
                        <option>Select</option>
                        @foreach (config('settings.currenct_list') as $key => $currency)
                            <option {{ $currency === $StripeSetting->currency ? 'selected' : '' }}
                                value="{{ $currency }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency rate (Per {{ $StripeSetting->currency }})</label>
                    <input type="text" value="{{ $StripeSetting->currency_rate }}" class="form-control"
                        name="currency_rate" value="">
                </div>
                <div class="form-group">
                    <label>Stripe Client Id</label>
                    <input type="text" class="form-control" value="{{ $StripeSetting->client_id }}" name="client_id"
                        value="">
                </div>
                <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input type="text" class="form-control" value="{{ $StripeSetting->secret_key }}"
                        name="secret_key">
                </div>


                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
