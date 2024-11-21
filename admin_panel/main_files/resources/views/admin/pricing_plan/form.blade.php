<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="plan_type">{{ __('admin.Plan Type') }} <span
                    class="text-danger">*</span></label>
            <select name="plan_type" id="plan_type" class="form-control">
                <option
                    value="premium" {{ old('plan_type', $plan->plan_type ?? '') == 'premium' ? 'selected' : '' }}>{{ __('admin.Premium') }}</option>
                <option
                    value="free" {{ old('plan_type', $plan->plan_type ?? '') == 'free' ? 'selected' : '' }}>{{ __('admin.Free') }}</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="plan_price">{{ __('admin.Plan Price') }} <span
                    class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="plan_price" id="plan_price"
                       class="form-control"
                       value="{{ old('plan_price', $plan->plan_price ?? '') }}"
                       inputmode="decimal" step="0.01">
                <span class="input-group-text">{{ $currency }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="plan_name">{{ __('admin.Plan Name') }} <span
                    class="text-danger">*</span></label>
            <input type="text" name="plan_name" class="form-control"
                   value="{{ old('plan_name', $plan->plan_name ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="expired_time">{{ __('admin.Expiration') }} <span
                    class="text-danger">*</span></label>
            <select name="expired_time" id="expired_time" class="form-control">
                <option
                    value="monthly" {{ old('expired_time', $plan->expired_time ?? '') == 'monthly' ? 'selected' : '' }}>{{ __('admin.Monthly') }}</option>
                <option
                    value="yearly" {{ old('expired_time', $plan->expired_time ?? '') == 'yearly' ? 'selected' : '' }}>{{ __('admin.Yearly') }}</option>
                <option
                    value="lifetime" {{ old('expired_time', $plan->expired_time ?? '') == 'lifetime' ? 'selected' : '' }}>{{ __('admin.Lifetime') }}</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="upload_limit">
                {{ __('admin.Upload Limit') }}
                <span class="text-danger">*</span>
                <i class="fas fa-info-circle" data-toggle="tooltip" title="Maximum number of products that can be uploaded. Use -1 for unlimited"></i>
            </label>
            <input type="number" name="upload_limit" class="form-control"
                   value="{{ old('upload_limit', $plan->upload_limit ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="serial">{{ __('admin.Serial') }} <span
                    class="text-danger">*</span></label>
            <input type="number" name="serial" class="form-control"
                   value="{{ old('serial', $plan->serial ?? '') }}">
        </div>
    </div>
</div>
