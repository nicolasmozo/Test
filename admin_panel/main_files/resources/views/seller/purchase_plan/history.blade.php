@extends('seller.master_layout')
@section('title')
    <title>{{ $pageTitle }}</title>
@endsection
@section('seller-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __($pageTitle) }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('seller.dashboard') }}">{{ __('admin.Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('admin.Purchase History') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th width="5%">{{__('admin.SN')}}</th>
                                            <th width="10%">{{__('admin.Order Id')}}</th>
                                            <th width="10%">{{__('user_validation.Purchase Date')}}</th>
                                            <th width="10%">{{__('user_validation.Expire Date')}}</th>
                                            <th width="10%">{{__('admin.Amount')}}</th>
                                            <th width="10%">{{__('user_validation.Upload Limit')}}</th>
                                            <th width="10%">{{__('admin.Payment Method')}}</th>
                                            <th width="10%">{{__('admin.Payment Status')}}</th>
                                            <th width="10%">{{__('admin.Order Status')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($orders as $index => $order)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $order->order_id}}</td>
                                                <td>{{ Carbon\Carbon::parse($order->created_at)->format('d F, Y') }}</td>
                                                <td>{{ $order->expiration_date }}</td>
                                                <td>{{ $currency }}{{ $order->plan_price }}</td>
                                                <td>
                                                    @if ($order->upload_limit == App\Constants\Status::UNLIMITED)
                                                        {{ __('user_validation.Unlimited')}}
                                                    @else
                                                        {{ $order->upload_limit }}
                                                    @endif
                                                </td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>
                                                    @if ($order->payment_status == App\Constants\Status::PENDING)
                                                        <span class="badge badge-danger">{{__('admin.Pending')}} </span>
                                                    @elseif ($order->payment_status == App\Constants\Status::SUCCESS)
                                                        <span
                                                            class="badge badge-success">{{__('admin.Complete')}} </span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger">{{__('admin.Canceled')}} </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->status == App\Constants\Status::PENDING)
                                                        <span class="badge badge-danger">{{__('admin.Pending')}} </span>
                                                    @elseif ($order->status == App\Constants\Status::SUCCESS)
                                                        <span
                                                            class="badge badge-success">{{__('admin.Complete')}} </span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger">{{__('admin.Canceled')}} </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Paginate Start Here -->
                            @if($orders->hasPages())
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                            {{ $orders->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Paginate End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
