@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Provider withdraw')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
              @if(request()->routeIs('admin.rejectedProviderWithdraw'))
                <h1>{{__('admin.Rejected withdraw')}}</h1>
              @elseif(request()->routeIs('admin.pending-provider-withdraw'))
                  <h1>{{__('admin.Pending seller withdraw')}}</h1>
              @else
                  <h1>{{__('admin.Seller withdraw')}}</h1>
              @endif
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
                @if(request()->routeIs('admin.rejectedProviderWithdraw'))
                    <div class="breadcrumb-item">{{__('admin.Rejected withdraw')}}</div>
                @elseif(request()->routeIs('admin.pending-provider-withdraw'))
                    <div class="breadcrumb-item">{{__('admin.Pending seller withdraw')}}</div>
                @else
                    <div class="breadcrumb-item">{{__('admin.Seller withdraw')}}</div>
                @endif
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
                                    <th >{{__('admin.SN')}}</th>
                                    <th >{{__('admin.Seller')}}</th>
                                    <th >{{__('admin.Method')}}</th>
                                    <th >{{__('admin.Charge')}}</th>
                                    <th >{{__('admin.Total Amount')}}</th>
                                    <th >{{__('admin.Withdraw Amount')}}</th>
                                    <th >{{__('admin.Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdraws as $index => $withdraw)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            <a href="{{ route('admin.provider-show', $withdraw->user_id) }}">{{ html_decode($withdraw->provider->name) }}</a>
                                        </td>
                                        <td>{{ $withdraw->method }}</td>
                                        <td>{{ $setting->currency_icon }}{{ sprintf('%.2f',($withdraw->total_amount - $withdraw->withdraw_amount)) }}</td>
                                        <td>{{ $setting->currency_icon }}{{ sprintf('%.2f',$withdraw->total_amount) }}</td>
                                        <td>{{ $setting->currency_icon }}{{ sprintf('%.2f',$withdraw->withdraw_amount) }}</td>
                                        <td>
                                            @php echo $withdraw->statusBadge @endphp
                                        </td>
                                        @if(request()->routeIs('admin.rejectedProviderWithdraw'))
                                        <td>
                                            <a href="{{ route('admin.show-provider-withdraw',$withdraw->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                        @endif

                                    @if(!request()->routeIs('admin.rejectedProviderWithdraw'))
                                        <td>
                                            <a href="{{ route('admin.show-provider-withdraw',$withdraw->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $withdraw->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                        @endif
                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
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
            $("#deleteForm").attr("action",'{{ url("admin/delete-seller-withdraw/") }}'+"/"+id)
        }
    </script>
@endsection
