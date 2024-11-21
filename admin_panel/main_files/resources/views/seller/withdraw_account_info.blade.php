@php
$setting = App\Models\Setting::first();
@endphp
<div class="alert alert-primary" role="alert">
    <h5>{{__('admin.Withdraw Limit')}} :

        {{ $setting->currency_icon }}{{ round($method->min_amount) }} - {{ $setting->currency_icon }}{{ round($method->max_amount) }}

    </h5>
    <h5>{{__('admin.Withdraw charge')}} : {{ $method->withdraw_charge }}%
    @if($setting->payout_type == \App\Constants\Status::COMMISSION_BASED)
        @lang('+') {{ __('user_validation.Commission Charge') }} : {{ $setting->commission_percentage }}%
    @endif
    </h5>
    {!! clean($method->description) !!}
</div>
