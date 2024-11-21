@extends('admin.master_layout')
@section('title')
    <title>{{__('admin.Create Pricing Plan')}}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('admin.Pricing Plan')}}</h1>
            </div>

            <div class="section-body">
                <a href="{{ route('admin.pricing-plan.index') }}" class="btn btn-primary"><i
                        class="fas fa-list"></i> {{__('admin.Pricing Plan')}}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form
                                    action="{{ isset($plan) ? route('admin.pricing-plan.update', $plan->id) : route('admin.pricing-plan.store') }}"
                                    method="post">
                                    @csrf

                                    @if(isset($plan))
                                        @method('PUT')
                                    @endif

                                    @include('admin.pricing_plan.form')

                                    <button
                                        class="btn btn-primary">{{ isset($plan) ? __('admin.Update') : __('admin.Save') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script>
        $(document).ready(function () {
            let planType = $('#plan_type');
            let planPrice = $('#plan_price');
            let originalPrice = planPrice.val();

            function handlePlanTypeChange() {
                if (planType.val() === 'free') {
                    planPrice.val(0);
                    planPrice.prop('disabled', true);
                } else {
                    planPrice.prop('disabled', false);
                    if (planPrice.val() == '0' && originalPrice !== '0') {
                        planPrice.val(originalPrice);
                    }
                }
            }

            planType.on('change', handlePlanTypeChange);
            handlePlanTypeChange();
        });
    </script>
@endsection
