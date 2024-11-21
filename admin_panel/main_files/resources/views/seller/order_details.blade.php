@extends('seller.master_layout')
@section('title')
<title>{{__('admin.Order Item Details')}}</title>
@endsection
@section('seller-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Order Item Details')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body ticket-message">
                            <div class="list-group">
                                @foreach ($messages as $message)
                                    @if ($message->send_seller == 0)
                                        <div class="list-group-item list-group-item-action flex-column align-items-start author_message mb-2">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1"> {{ $customer->name }}</h6> <small>{{ $message->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1">{!! html_decode(clean(nl2br($message->message))) !!}</p>



                                        </div>
                                    @else
                                        <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ $seller->name }} <small>({{__('admin.me')}})</small></h6> <small>{{ $message->created_at->diffForHumans() }} </small>
                                            </div>
                                            <p class="mb-1">{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                        </div>

                                    @endif
                                @endforeach


                            </div>

                            <div class="message-box mt-4">
                                <form action="{{ route('seller.store-product-message', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <textarea required name="message" placeholder="{{__('admin.Type here')}}.." class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                                    </div>

                                    <button class="btn btn-primary" type="submit">{{__('admin.Submit')}}</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>{{__('admin.Order Information')}}</h6>
                            <hr>
                            <p>{{__('admin.Product')}}: {{ html_decode($item->product_name) }}</p>
                            <p>{{__('admin.Service')}}: {{ html_decode($item->variant_name) }}</p>
                            <p>{{__('admin.Option')}}: {{ html_decode($item->option_name) }}</p>
                            <p>{{__('admin.Qty')}}: {{ html_decode($item->qty) }}</p>
                            <p>{{__('admin.Amount')}}: {{ $setting->currency_icon }}{{ round($item->option_price) }}</p>


                            <p>{{__('admin.Order Id')}}: #{{ $item->track_id }}</p>
                            <p>{{__('admin.Created')}}: {{ $item->created_at->format('h:m A, d-M-Y') }}</p>
                            <p>{{__('admin.Status')}}:
                                @if ($item->approve_by_user == 'pending')
                                <span class="badge badge-danger">{{__('admin.Pending')}} </span>
                                @elseif ($item->approve_by_user == 'approved')
                                <span class="badge badge-success">{{__('admin.Complete')}} </span>
                                @else
                                <span class="badge badge-danger">{{__('admin.Canceled')}} </span>
                                @endif
                            </p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
