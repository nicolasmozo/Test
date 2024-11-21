@extends('admin.master_layout')
@section('title')
    <title>{{__('admin.Pricing Plan')}}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('admin.Pricing Plan')}}</h1>
            </div>

            <div class="section-body">
                <a href="{{ route('admin.pricing-plan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th >{{__('admin.SN')}}</th>
                                            <th >{{__('admin.Plan Name')}}</th>
                                            <th >{{__('admin.Price')}}</th>
                                            <th >{{__('admin.Expire Date')}}</th>
                                            <th >{{__('admin.Status')}}</th>
                                            <th >{{__('admin.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($plans as $index => $plan)
                                            <tr>
                                                <td>{{ $plan->serial }}</td>
                                                <td>{{ $plan->plan_name }}</td>
                                                <td>{{ $currency }}
                                                    {{ $plan->plan_price ?? '0'}}
                                                </td>
                                                <td>{{ $plan->expired_time }}</td>
                                                <td>
                                                    @if($plan->status == App\Constants\Status::ACTIVE)
                                                        <a href="javascript:;" onclick="changeProductCategoryStatus({{ $plan->id }})">
                                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                                        </a>

                                                    @else
                                                        <a href="javascript:;" onclick="changeProductCategoryStatus({{ $plan->id }})">
                                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                                        </a>

                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.pricing-plan.edit',$plan->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $plan->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/pricing-plan/") }}'+"/"+id)
        }
        function changeProductCategoryStatus(id){
            var isDemo = "{{ env('APP_MODE') }}"
            if(isDemo == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $.ajax({
                type:"put",
                data: { _token : '{{ csrf_token() }}' },
                url:"{{url('/admin/pricing-plan/status/')}}"+"/"+id,
                success:function(response){
                    toastr.success(response)
                },
                error:function(err){


                }
            })
        }
    </script>
@endsection
