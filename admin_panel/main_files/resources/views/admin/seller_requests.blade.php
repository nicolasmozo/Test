@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Seller Request')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Seller Request')}}</h1>

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
                                    <th >{{__('admin.User Name')}}</th>
                                    <th >{{__('admin.Company Name')}}</th>
                                    <th >{{__('admin.Email')}}</th>
                                    <th >{{__('admin.Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($seller_requests as $index => $seller_request)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><a href="{{ route('admin.provider-show', $seller_request->user_id) }}">{{ html_decode($seller_request?->user?->name) }}</a></td>
                                        <td>{{ html_decode($seller_request->company_name) }}</td>
                                        <td>{{ html_decode($seller_request->email) }}</td>
                                        <td>
                                            @if($seller_request->status == 'pending')
                                            <span class="badge badge-danger">{{ __('admin.Pending') }}</span>
                                            @elseif ($seller_request->status == 'rejected')
                                            <span class="badge badge-danger">{{ __('admin.Rejected') }}</span>
                                            @else
                                            <span class="badge badge-success">{{ __('admin.Approved') }}</span>

                                            @endif
                                        </td>
                                        <td>

                                        <a href="{{ route('admin.seller-request',$seller_request->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $seller_request->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>


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
        </section>
      </div>



      <!-- Modal -->
      <div class="modal fade" id="canNotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                      <div class="modal-body">
                          {{__('admin.You can not delete this seller. Because there are one or more products and shop account has been created in this seller.')}}
                      </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                </div>
            </div>
        </div>
    </div>

<script>
  "use strict";
  function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/delete-seller-request/") }}'+"/"+id)
    }


    function manageCustomerStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/provider-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
