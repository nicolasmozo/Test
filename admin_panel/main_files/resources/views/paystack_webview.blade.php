<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('user.Paystack Payment')}}</title>
    <link rel="icon" type="image/png" href="{{ asset($setting->favicon) }}">

    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>

    <style>
        .payment_notify {
            text-align: center;
        }
    </style>
</head>
<body>

    <p class="payment_notify">{{ __('Please wait. Your payment is processing....') }}</p>
    <p class="payment_notify">{{ __('Do not press browser back or forward button while you are in payment page') }}</p>


{{-- paystack start --}}

@php
    $public_key = $paystack->paystack_public_key;
    $currency = $paystack->paystackcurrency->currency_code;
    $currency = strtoupper($currency);

    $ngn_amount = $calculate_amount['payable_amount'] * $paystack->paystackcurrency->currency_rate;
    $ngn_amount = $ngn_amount * 100;
    $ngn_amount = round($ngn_amount);
@endphp
<script>

    payWithPaystack()
    function payWithPaystack(){

        var handler = PaystackPop.setup({
            key: '{{ $public_key }}',
            email: '{{ $user->email }}',
            amount: '{{ $ngn_amount }}',
            currency: "{{ $currency }}",
            callback: function(response){
            let reference = response.reference;
            let tnx_id = response.transaction;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                type: "get",
                data: {reference, tnx_id, _token},
                url: "{{ url('payment-api/paystack-webview-payment') }}",
                success: function(response) {

                    if(response.status == 'success'){
                        window.location.href = "{{ route('payment-api.webview-success-payment') }}";
                    }else{
                        window.location.href = "{{ route('payment-api.webview-faild-payment') }}";
                    }
                },
                error: function(response){
                    window.location.href = "{{ route('payment-api.webview-faild-payment') }}";
                }
            });
            },
            onClose: function(){
                alert('window closed');
            }
        });
        handler.openIframe();

    }
</script>

{{-- end paystack --}}

</body>
</html>
