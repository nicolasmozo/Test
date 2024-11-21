@extends('admin.master_layout')
@section('title')
    <title>{{__('admin.Purchase List')}}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('admin.Purchase List')}}</h1>
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
                                            <th >{{__('admin.Plan Name')}}</th>
                                            <th >{{__('admin.Price')}}</th>
                                            <th >{{__('admin.Expire Date')}}</th>
                                            <th >{{__('admin.Upload Limit')}}</th>
                                            <th >{{__('admin.Payment Method')}}</th>
                                            <th >{{__('admin.Payment Status')}}</th>
                                            <th >{{__('admin.Order Status')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($lists as $index => $list)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>

                                                    {{ $list->user->name ?? 'No user found' }}
                                                </td>
                                                <td>{{ $list->plan_name }}</td>
                                                <td>{{ $currency }}
                                                    {{ $list->plan_price ?? '0'}}
                                                </td>
                                                <td>{{ $list->expiration_date }}</td>
                                                <td>{{ formatUploadLimit($list->upload_limit) }}</td>                                                <td>{{ $list->payment_method }}</td>
                                                <td>
                                                    @php echo $list->paymentBadge @endphp
                                                </td>
                                                <td>
                                                    @php echo $list->statusBadge @endphp
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
@endsection
