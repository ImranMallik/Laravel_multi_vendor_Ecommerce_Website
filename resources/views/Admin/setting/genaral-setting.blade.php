<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.genaral-setting-update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" name="site_name" value="{{ @$GenaralSetting->site_name }}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label>Layout</label>
                    <select name="layout" class="form-control">
                        <option {{ @$GenaralSetting->latoyt == 'LTR' ? 'selected' : '' }} value="LTR">LTR</option>
                        <option {{ @$GenaralSetting->latoyt == 'RTL' ? 'selected' : '' }} value="RLT">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="text" name="contact_email" value="{{ @$GenaralSetting->contact_email }}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label>Default Currency Name</label>
                    <select name="currency_name" class="form-control select2" id="">
                        <option value="">Select</option>
                        @foreach (config('settings.currenct_list') as $value)
                            <option {{ @$GenaralSetting->currency_name == $value ? 'selected' : '' }}
                                value="{{ $value }} ">
                                {{ $value }}</option>
                        @endforeach


                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Icon</label>
                    <input type="text" class="form-control" value="{{ @$GenaralSetting->currency_icon }}"
                        name="currency_icon" id="">
                </div>
                <div class="form-group">
                    <label>Timezone</label>
                    <select name="time_zone" class="form-control select2" id="">
                        <option value="">Select</option>
                        @foreach (config('settings.time_zone') as $key => $time)
                            <option {{ @$GenaralSetting->time_zone == $key ? 'selected' : '' }}
                                value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
