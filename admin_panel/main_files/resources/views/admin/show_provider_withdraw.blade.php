@extends('admin.master_layout')
@section('title')
    <title>{{__('admin.Withdraw Details')}}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('admin.Withdraw Details')}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
                    <div class="breadcrumb-item">{{__('admin.Withdraw Details')}}</div>
                </div>
            </div>
            <div class="section-body">
                <a href="{{ route('admin.provider-withdraw') }}" class="btn btn-primary"><i
                        class="fas fa-list"></i> {{__('admin.Seller withdraw')}}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <td width="50%">{{__('admin.Seller')}}</td>
                                        <td width="50%">
                                            <a href="{{ route('admin.provider-show', $withdraw->user_id) }}">{{ html_decode($withdraw->provider->name) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{__('admin.Withdraw Method')}}</td>
                                        <td width="50%">{{ $withdraw->method }}</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">{{__('admin.Withdraw Charge')}}</td>
                                        <td width="50%">{{ $withdraw->withdraw_charge }}%</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">{{__('admin.Withdraw Charge Amount')}}</td>
                                        <td width="50%">{{ $setting->currency_icon }}{{ sprintf('%.2f',($withdraw->total_amount - $withdraw->withdraw_amount)) }}</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">{{__('admin.Total amount')}}</td>
                                        <td width="50%">{{ $setting->currency_icon }}{{ sprintf('%.2f',$withdraw->total_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{__('admin.Withdraw amount')}}</td>
                                        <td width="50%">{{ $setting->currency_icon }}{{ sprintf('%.2f',$withdraw->withdraw_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{__('admin.Status')}}</td>
                                        <td width="50%">
                                            @php echo $withdraw->statusBadge @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{__('admin.Requested Date')}}</td>
                                        <td width="50%">{{ $withdraw->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    @if ($withdraw->status == \App\Constants\Status::ENABLE)
                                        <tr>
                                            <td width="50%">{{__('admin.Approved Date')}}</td>
                                            <td width="50%">{{ $withdraw->approved_date }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td width="50%">{{__('admin.Account Information')}}</td>
                                        <td width="50%">
                                            {!! clean(nl2br(html_decode($withdraw->account_info))) !!}
                                        </td>
                                    </tr>
                                    @if($withdraw->feedback !== null)
                                        <tr>
                                            <td width="50%">{{__('admin.Reject Reason')}}</td>
                                            <td width="50%">
                                                {!! clean(nl2br(html_decode($withdraw->feedback))) !!}
                                            </td>
                                        </tr>
                                    @endif
                                </table>

                                @if ($withdraw->status == \App\Constants\Status::PENDING)
                                    <a href="javascript:;" data-toggle="modal" data-target="#withdrawApproved"
                                       class="btn btn-primary">{{__('admin.Approve withdraw')}}</i></a>
                                @endif

                                @if ($withdraw->status == \App\Constants\Status::SUCCESS || $withdraw->status !== \App\Constants\Status::REJECTED)
                                    <a href="javascript:;" data-toggle="modal" data-target="#rejectModal"
                                       class="btn btn-warning"
                                       onclick="deleteData({{ $withdraw->id }})">{{__('admin.Reject withdraw request')}}
                                    </a>
                                @endif

                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal"
                                   class="btn btn-danger"
                                   onclick="deleteData({{ $withdraw->id }})">{{__('admin.Delete withdraw request')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="withdrawApproved">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('admin.Withdraw Approved Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('admin.Are You sure approved this withdraw request ?')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.approved-provider-withdraw',$withdraw->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approve')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="rejectModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('admin.Withdraw Reject')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('admin.Are You sure reject this withdraw request ?')}}</p>
                    <form action="{{ route('admin.reject-provider-withdraw',$withdraw->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="reason">{{__('admin.Reason')}}</label>
                            <input type="hidden" name="status" value="2">
                            <textarea class="form-control" name="feedback" id="feedback" rows="4" cols="50"
                                      placeholder="{{__('admin.Enter rejection reason')}}" required></textarea>
                        </div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Reject')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url("admin/delete-seller-withdraw/") }}' + "/" + id)
        }
    </script>
@endsection
