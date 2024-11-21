@extends('seller.master_layout')
@section('title')
<title>{{__('user_validation.Subscription Payment')}}</title>
@endsection
@section('seller-content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('user_validation.Subscription Payment')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @if ($stripe->status == 1)
                        <div class="col-md-4 mt-4">
                            <div class="thumbnail">
                                <div class="image-area">
                                    <img src="{{ asset($stripe->image) }}" alt="Lights" class="w-100 gateway-image">
                                </div>

                                <div class="caption text-center mt-3">
                                    <button type="button" data-toggle="modal" data-target="#stripeModal"
                                        class="btn btn-primary">{{__('user_validation.Pay via Stripe')}}</button>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($paypal->status == \App\Constants\Status::ENABLE)
                        <div class="col-md-4 mt-4">
                            <div class="thumbnail">
                                <div class="image-area">
                                    <img src="{{ asset($paypal->image) }}" alt="Lights" class="w-100 gateway-image">
                                </div>
                                <div class="caption text-center mt-3">
                                    <a href="{{ route('paypal.create', $plan->plan_slug) }}"
                                        class="btn btn-primary">
                                        {{__('user_validation.Pay via PayPal')}}</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($razorpay->status == \App\Constants\Status::ENABLE)
                        <div class="col-md-4 mt-4">
                            <div class="thumbnail">
                                <div class="image-area">
                                    <img src="{{ asset($razorpay->image) }}" alt="Lights" class="w-100 gateway-image">
                                </div>
                                <div class="caption text-center mt-3">
                                    <button type="button" id="razorpay_pay_btn" class="btn btn-primary">
                                        {{__('user_validation.Pay via Razorpay')}}</button>
                                </div>
                            </div>
                        </div>


                        <form action="{{ route('pay-with-razorpay', $plan->plan_slug) }}" method="POST" class="d-none">
                            @csrf
                            @php
                            $plan_price = $plan->plan_price;
                            $payableAmount = round($plan_price * $razorpay->currency_rate,2);
                            @endphp
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ $razorpay->key }}"
                                data-currency="{{ $razorpay->currency_code }}" data-amount="{{ $payableAmount * 100 }}"
                                data-buttontext="{{__('user_validation.Pay via  Razorpay')}}"
                                data-name="{{ $razorpay->name }}" data-description="{{ $razorpay->description }}"
                                data-image="{{ asset($razorpay->image) }}" data-prefill.name="" data-prefill.email=""
                                data-theme.color="{{ $razorpay->theme_color }}">
                            </script>
                        </form>
                        @endif

                        @if ($flutterwave->status == \App\Constants\Status::ENABLE)
                        <div class="col-md-4 mt-4">
                            <div class="thumbnail">
                                <div class="image-area">
                                    <img src="{{ asset($flutterwave->logo) }}" alt="Lights" class="w-100 gateway-image">
                                </div>
                                <div class="caption text-center mt-3">
                                    <button type="button" class="btn btn-primary" onclick="paywithFlutterwave()">
                                        {{__('user_validation.Pay via Flutterwave')}}</button>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($paystack->paystack_status == \App\Constants\Status::ENABLE)
                        <div class="col-md-4 mt-4">
                            <div class="thumbnail">
                                <div class="image-area">
                                    <img src="{{ asset($paystack->paystack_image) }}" alt="Lights"
                                        class="w-100 gateway-image">
                                </div>
                                <div class="caption text-center mt-3">
                                    <button type="submit" class="btn btn-primary"
                                        onclick="payWithPaystack()">{{__('user_validation.Pay via Paystack')}}</button>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($mollie->mollie_status == \App\Constants\Status::ENABLE)
                        <div class="col-md-4 mt-4">
                            <div class="thumbnail">
                                <div class="image-area">
                                    <img src="{{ asset($mollie->mollie_image) }}" alt="Lights"
                                        class="w-100 gateway-image">
                                </div>
                                <div class="caption text-center mt-3">
                                    <a href="{{ route('pay-with-mollie', $plan->plan_slug) }}" class="btn btn-primary">
                                        {{__('user_validation.Pay via Mollie')}}</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($instamojo->status == \App\Constants\Status::ENABLE)
                        <div class="col-md-4 mt-4">
                            <div class="thumbnail">
                                <div class="image-area">
                                    <img src="{{ asset($instamojo->image) }}" alt="Lights" class="w-100 gateway-image">
                                </div>
                                <div class="caption text-center mt-3">
                                    <a href="{{ route('pay-with-instamojo', $plan->plan_slug) }}"
                                        class="btn btn-primary">
                                        {{__('user_validation.Pay via Instamojo')}}</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($bank_payment->status == \App\Constants\Status::ENABLE)
                        <div class="col-md-4 mt-4">
                            <div class="thumbnail">
                                <div class="image-area">
                                    <img src="{{ asset($bank_payment->image) }}" alt="Lights"
                                        class="w-100 gateway-image">
                                </div>
                                <div class="caption text-center mt-3">
                                    <a href="javascript:;" data-toggle="modal" data-target="#bankPayment"
                                        class="btn btn-primary">
                                        {{__('user_validation.Pay via Bank')}}</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pricing pricing-highlight">
                        <div class="pricing-title">
                            {{ $plan->plan_name }}
                        </div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>{{ $setting->currency_icon }}{{ sprintf('%0.2f', $plan->plan_price) }}</div>
                                <div>
                                    @if ($plan->expiration_date == 'monthly')
                                    {{__('user_validation.Monthly')}}

                                    @elseif ($plan->expiration_date == 'yearly')
                                    {{__('user_validation.Yearly')}}

                                    @elseif ($plan->expiration_date == 'lifetime')

                                    {{__('user_validation.Lifetime')}}
                                    @endif
                                </div>
                            </div>
                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">
                                        @if($plan->upload_limit == App\Constants\Status::UNLIMITED)
                                        {{ __('Unlimited') }} {{__('user_validation.Products Upload')}}
                                        @else
                                        {{ @$plan->upload_limit }} {{__('user_validation.Products Upload')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Stripe Modal -->
<div class="modal fade" id="stripeModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('user_validation.Stripe Payment')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form role="form" action="{{ route('pay-with-stripe', $plan->plan_slug) }}" method="post"
                        class="require-validation" data-cc-on-file="false"
                        data-stripe-publishable-key="{{ $stripe->stripe_key }}" id="payment-form">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group required">
                                    <label for="">{{__('user_validation.Card Number')}}</label>
                                    <input type="text" autocomplete="off" name="card_number"
                                        class="form-control card-number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label for="">{{__('user_validation.Expired Month')}}</label>
                                    <input type="text" autocomplete="off" name="month" min="1" max="12"
                                        class="form-control card-expiry-month"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 2) this.value = this.value.slice(0,2); if(this.value > 12) this.value = 12;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label for="">{{__('user_validation.Expired Year')}}</label>
                                    <input type="text" autocomplete="off" name="year"
                                        class="form-control card-expiry-year"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 2) this.value = this.value.slice(0,2);">
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group">
                                    <label for="">{{__('user_validation.CVC')}}</label>
                                    <input type="text" autocomplete="off" name="cvc" class="form-control card-cvc">
                                </div>
                            </div>

                            <div class='form-group col-12 error d-none'>
                                <div class='col-md-12  form-group '>
                                    <div class='alert-danger alert'>
                                        {{__('user_validation.Please provide your valid card information')}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary btn-lg btn-block"
                                    type="submit">{{__('user_validation.Pay Now')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bank Modal -->
<div class="modal fade" id="bankPayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('user_validation.Bank Payment')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="mb-2">
                        {!! nl2br($bank_payment->account_info) !!}
                    </div>

                    <form action="{{ route('bank-payment', $plan->plan_slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">{{__('user_validation.Transaction')}}</label>
                                <textarea name="transaction_id" class="form-control text-area-5"></textarea>
                            </div>

                        </div>

                        <button class="btn btn-primary btn-lg btn-block"
                            type="submit">{{__('user_validation.Submit')}}</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>



@php
$plan_price = $plan->plan_price;

// start paystack
$public_key = $paystack->paystack_public_key;
$currency = $paystack->paystack_currency_code;
$currency = strtoupper($currency);

$ngn_amount = $plan_price * $paystack->paystack_currency_rate;
$ngn_amount = $ngn_amount * 100;
$ngn_amount = round($ngn_amount);
// end paystack

// start fluttewave
$payable_amount = $plan_price * $flutterwave->currency_rate;
$payable_amount = round($payable_amount, 2);
@endphp


<script src="https://js.stripe.com/v2/"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<script>
    'use strict'

    document.querySelector('.card-expiry-month').addEventListener('blur', function() {
        if (this.value < 1) this.value = 1;
        if (this.value.length == 1) this.value = '0' + this.value;
    });

    document.querySelector('.card-expiry-year').addEventListener('blur', function() {
        if (this.value.length == 1) this.value = '0' + this.value;
    });


    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('d-none');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $('.error').removeClass('d-none');

                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

        $("#razorpay_pay_btn").on("click", function() {

            $(".razorpay-payment-button").click();
        })

    });


    function paywithFlutterwave() {
        FlutterwaveCheckout({
            public_key: "{{ $flutterwave->public_key }}",
            tx_ref: "{{ rand(4444,44444444) }}",
            amount: {{ $payable_amount }},
            currency: "{{ $flutterwave->currency_code }}",
            country: "{{ $flutterwave->country_code }}",
            payment_options: " ",
            customer: {
                email: "{{ $user->email }}",
                phone_number: "{{ $user->phone }}",
                name: "{{ $user->name }}",
            },
            callback: function(data) {
                var tnx_id = data.transaction_id;
                var _token = "{{ csrf_token() }}";
                var plan_id = '{{ $plan->plan_slug }}';
                $.ajax({
                    type: 'post',
                    data: {
                        tnx_id,
                        _token,
                        plan_id
                    },
                    url: "{{ route('pay-with-flutterwave', $plan->plan_slug) }}",
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "{{ route('seller.purchase-history') }}";
                        } else {
                            window.location.reload();
                        }
                    },
                    error: function(err) {
                        window.location.reload();
                    }
                });

            },
            customizations: {
                title: "{{ $flutterwave->title }}",
                logo: "{{ asset($flutterwave->logo)}}",
            },
        });
    }

    function payWithPaystack() {
        var plan_id = '{{ $plan->plan_slug }}';

        var handler = PaystackPop.setup({
            key: '{{ $public_key }}',
            email: '{{ $user->email }}',
            amount: '{{ $ngn_amount }}',
            currency: "{{ $currency }}",
            callback: function(response) {
                let reference = response.reference;
                let tnx_id = response.transaction;
                let _token = "{{ csrf_token() }}";
                $.ajax({
                    type: "post",
                    data: {
                        reference,
                        tnx_id,
                        _token,
                        plan_id
                    },
                    url: "{{ route('pay-with-paystack', $plan->plan_slug) }}",
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "{{ route('seller.purchase-history') }}";
                        } else {
                            window.location.reload();
                        }
                    }
                });
            },
            onClose: function() {
                alert('window closed');
            }
        });
        handler.openIframe();
    }
</script>

@endsection
