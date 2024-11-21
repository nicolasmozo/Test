<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Flutterwave Payment')}}</title>
    <link rel="icon" type="image/png" href="{{ asset($setting->favicon) }}">

    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <style>
        .payment_notify {
            text-align: center;
        }
    </style>
</head>
<body>

    <p class="payment_notify">{{ __('Please wait. Your payment is processing....') }}</p>
    <p class="payment_notify">{{ __('Do not press browser back or forward button while you are in payment page') }}</p>

    {{-- start flutterwave payment --}}
    @php
        $payable_amount = $calculate_amount['payable_amount'] * $flutterwave->currency->currency_rate;
        $payable_amount = round($payable_amount, 2);
    @endphp

    <script>
        flutterwavePayment();
        function flutterwavePayment() {
            FlutterwaveCheckout({
                public_key: "{{ $flutterwave->public_key }}",
                tx_ref: "{{ substr(rand(0,time()),0,10) }}",
                amount: {{ $payable_amount }},
                currency: "{{ $flutterwave->currency->currency_code }}",
                country: "{{ $flutterwave->currency->country_code }}",
                payment_options: " ",
                customer: {
                email: "{{ $user->email }}",
                phone_number: "{{ $user->phone }}",
                name: "{{ $user->name }}",
                },
                callback: function (data) {
                    var tnx_id = data.transaction_id;
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'post',
                        data : {tnx_id,_token},
                        url: "{{ url('payment-api/flutterwave-webview-payment') }}",
                        success: function (response) {
                            if(response.status == 'success'){
                                window.location.href = "{{ route('payment-api.webview-success-payment') }}";
                            }else{
                                window.location.href = "{{ route('payment-api.webview-faild-payment') }}";
                            }
                        },
                        error: function(err) {
                            window.location.href = "{{ route('payment-api.webview-faild-payment') }}";
                        }
                    });
                },
                customizations: {
                title: "{{ $flutterwave->title }}",
                logo: "{{ asset($flutterwave->logo) }}",
                },
            });
        }
    </script>
    {{-- end flutterwave payment --}}

</body>
</html>
