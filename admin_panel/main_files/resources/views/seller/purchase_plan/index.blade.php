@extends('seller.master_layout')
@section('title')
    <title>{{ $pageTitle }}</title>
@endsection
@section('seller-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('admin.Pricing') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('seller.dashboard') }}">{{ __('admin.Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('admin.Pricing') }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    @foreach($plans->sortBy('serial') as $plan)
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing pricing-highlight">
                            <div class="pricing-title">
                                {{ __($plan->plan_name) }}
                            </div>
                            <div class="pricing-padding">
                                <div class="pricing-price">
                                    <div>{{ $currency }}{{ __($plan->plan_price ?? '0') }}</div>
                                    <div>
                                        @if($plan->expired_time === \App\Constants\Status::LIFETIME)
                                            {{ __('user_validation.Lifetime') }}
                                        @else
                                            @lang('/ per') {{ __($plan->expired_time) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="pricing-details">
                                    <div class="pricing-item">
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">
                                            @if($plan->upload_limit == App\Constants\Status::UNLIMITED)
                                                {{ __('Unlimited') }}
                                            @else
                                                {{ $plan->upload_limit }}
                                            @endif
                                            {{ __('user_validation.Products Upload') }}
                                        </div>                                    </div>
                                </div>
                            </div>
                            @if($plan->plan_type === \App\Constants\Status::FREE)
                                <div class="pricing-cta">
                                    <a href="{{ route('freeEnroll', $plan->plan_slug) }}">{{ __('user_validation.Free Enroll') }} <i class="fas fa-arrow-right"></i></a>
                                </div>
                            @else
                                <div class="pricing-cta">
                                    <a href="{{ route('payment', $plan->plan_slug) }}">{{ __('user_validation.Subscribe') }} <i class="fas fa-arrow-right"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
