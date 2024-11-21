@extends('admin.master_layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('admin-content')
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
                                  @foreach ($orders as $index => $order)
                                      <tr>
                                          <td>{{ ++$index }}</td>
                                          <td><a href="{{ route('admin.customer-show', $order->user->id) }}">{{ $order->user->name}}</a></td>
                                          <td>{{ $order->order_id }}</td>
                                          <td>{{ Carbon\Carbon::parse($order->created_at)->format('d F, Y') }}</td>
                                          <td>{{ $order->cart_qty }}</td>
                                          <td>{{ $setting->currency_icon }}{{ round($order->total_amount) }}</td>
                                          <td>
                                              @if ($order->order_status == 1)
                                              <span class="badge badge-success">{{__('admin.Complete')}} </span>
                                              @elseif ($order->order_status == 0)
                                              <span class="badge badge-danger">{{__('admin.Pending')}} </span>
                                              @endif
                                          </td>
                                          <td>
                                              @if($order->payment_status == 'success')
                                              <span class="badge badge-success">{{__('admin.success')}} </span>
                                              @else
                                              <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                              @endif
                                          </td>

                                          <td>

                                          <a href="{{ route('admin.order-show',$order->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                          <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $order->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                          </td>
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


<script>
  "use strict";
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/delete-order/") }}'+"/"+id)
    }
</script>
@endsection
