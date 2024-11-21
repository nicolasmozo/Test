@extends('seller.master_layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('seller-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ $title }}</h1>
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
                                      <th width="10%">{{__('admin.Customer')}}</th>
                                      <th width="10%">{{__('admin.Order Id')}}</th>
                                      <th width="10%">{{__('admin.Date')}}</th>
                                      <th width="10%">{{__('admin.Quantity')}}</th>
                                      <th width="10%">{{__('admin.Amount')}}</th>
                                      <th width="10%">{{__('admin.Order Status')}}</th>
                                      <th width="10%">{{__('admin.Payment')}}</th>
                                      <th width="15%">{{__('admin.Action')}}</th>
                                    </tr>
                              </thead>
                              <tbody>
                                  @foreach ($order_items as $index => $order_item)
                                      <tr>
                                          <td>{{ ++$index }}</td>
                                          <td>{{ $order_item->user->name}}</td>
                                          <td>#{{ $order_item->track_id }}</td>
                                          <td>{{ Carbon\Carbon::parse($order_item->created_at)->format('d F, Y') }}</td>
                                          <td>{{ $order_item->qty }}</td>
                                          <td>{{ $setting->currency_icon }}{{ round($order_item->option_price) }}</td>
                                          <td>
                                              @if ($order_item->approve_by_user == 'pending')
                                              <span class="badge badge-danger">{{__('admin.Pending')}} </span>
                                              @elseif ($order_item->approve_by_user == 'approved')
                                              <span class="badge badge-success">{{__('admin.Complete')}} </span>
                                              @else
                                              <span class="badge badge-danger">{{__('admin.Canceled')}} </span>
                                              @endif
                                          </td>
                                          <td>
                                            <span class="badge badge-success">{{__('admin.success')}} </span>
                                          </td>

                                          <td>

                                            <a href="{{ url('seller/order-show',  ['item_id' => $order_item->id, 'order_id' => $order_item->track_id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>



                                      </tr>
                                    @endforeach
                              </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

            </div>
          </div>
        </section>
      </div>


@endsection
