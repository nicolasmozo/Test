
@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Seller Request Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Seller Request Details')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Seller Request Details')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>{{__('admin.Company Logo')}}</td>
                                <td>
                                    <img src="{{ asset($seller_request->logo) }}" class="rounded-circle" alt="" width="80px">
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.User name')}}</td>
                                <td><a href="{{ route('admin.provider-show', $seller_request->user_id) }}">{{ html_decode($seller_request?->user?->name) }}</a></td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Company name')}}</td>
                                <td>{{ html_decode($seller_request->company_name) }}</td>
                            </tr>
                            <tr>
                                <td>{{__('admin.Email')}}</td>
                                <td>{{ html_decode($seller_request->email) }}</td>
                            </tr>
                            <tr>
                                <td>{{__('admin.Phone')}}</td>
                                <td>{{ html_decode($seller_request->phone) }}</td>
                            </tr>
                            <tr>
                                <td>{{__('admin.Address')}}</td>
                                <td>{{ html_decode($seller_request->address) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Document Type')}}</td>
                                <td>{{ html_decode($seller_request->document_type) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Document Type')}}</td>
                                <td><a href="{{ asset($seller_request->document) }}" target="_blank">{{ __('admin.See here') }}</a></td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Status')}}</td>
                                <td>
                                    @if($seller_request->status == 'pending')
                                    <span class="badge badge-danger">{{ __('admin.Pending') }}</span>
                                    @elseif ($seller_request->status == 'rejected')
                                    <span class="badge badge-danger">{{ __('admin.Rejected') }}</span>
                                    @else
                                    <span class="badge badge-success">{{ __('admin.Approved') }}</span>

                                    @endif
                                </td>
                            </tr>
                        </table>

                        @if($seller_request->status == 'pending')
                            <button class="btn btn-success" data-toggle="modal" data-target="#approvedModal">{{ __('admin.Make Approved') }}</button>

                            <button class="btn btn-warning" data-toggle="modal" data-target="#rejectedModal">{{ __('admin.Make Rejected') }}</button>

                        @endif

                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger" onclick="deleteData({{ $seller_request->id }})">{{ __('admin.Delete') }}</a>

                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="approvedModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('admin.Seller Request Approval')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{__('admin.Are you realy want to approved this request?')}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form  action="{{ route('admin.approved-seller-request', $seller_request->id) }}" method="POST">
                    @csrf
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('admin.Yes, Apporved')}}</button>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="rejectedModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('admin.Seller Request Rejected')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{__('admin.Are you realy want to rejected this request?')}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form  action="{{ route('admin.reject-seller-request', $seller_request->id) }}" method="POST">
                    @csrf
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('admin.Yes, Rejected')}}</button>
                </form>
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
            url:"{{url('/admin/customer-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
