<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.paypal-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Paypal Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="mode" class="form-control">
                        <option value="1">SandBox</option>
                        <option value="0">Live</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country" id="" class="form-control select2">
                        <option>Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency" id="" class="form-control select2">
                        <option>Select</option>
                        @foreach (config('settings.currenct_list') as $key => $currency)
                            <option value="{{ $currency }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency rate (Per USD)</label>
                    <input type="text" class="form-control" name="currency_rate" value="">
                </div>
                <div class="form-group">
                    <label>Paypal Client Id</label>
                    <input type="text" class="form-control" name="client_id" value="">
                </div>
                <div class="form-group">
                    <label>Paypal Secret Key</label>
                    <input type="text" class="form-control" name="secret_key" value="">
                </div>


                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
