@extends('seller.master_layout')
@section('title')
    <title>{{__('admin.My withdraw')}}</title>
@endsection
@section('seller-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('admin.My withdraw')}}</h1>
            </div>

            <div class="section-body">
                <a href="{{ route('seller.my-withdraw.create') }}" class="btn btn-primary"><i
                        class="fas fa-plus"></i> {{__('admin.New withdraw')}}</a>

                <div class="row mt-5">

                    <div class="col-md-4">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{__('admin.Current Balance')}}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $setting->currency_icon }}{{ $current_balance }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-coins"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{__('admin.Total Earning')}}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $setting->currency_icon }}{{ $total_balance }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="javascript:;">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{__('admin.Total Withdraw')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $setting->currency_icon }}{{ $total_withdraw }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>


                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>{{__('admin.SN')}}</th>
                                            <th>{{__('admin.Method')}}</th>
                                            <th>{{__('admin.Charge')}}</th>
                                            <th>{{__('admin.Total Amount')}}</th>
                                            <th>{{__('admin.Withdraw Amount')}}</th>
                                            <th>{{__('admin.Status')}}</th>
                                            <th>{{__('admin.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($withdraws as $index => $withdraw)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $withdraw->method }}</td>
                                                <td>
                                                    {{ $setting->currency_icon }}{{ sprintf('%0.2f', ($withdraw->total_amount - $withdraw->withdraw_amount)) }}

                                                </td>
                                                <td>
                                                    {{ $setting->currency_icon }}{{ sprintf('%.2f',$withdraw->total_amount) }}
                                                </td>
                                                <td>
                                                    {{ $setting->currency_icon }}{{ sprintf('%.2f' ,$withdraw->withdraw_amount) }}
                                                </td>
                                                <td>
                                                    @php echo $withdraw->statusBadge @endphp
                                                </td>
                                                <td>
                                                    <a href="{{ route('seller.my-withdraw.show',$withdraw->id) }}"
                                                       class="btn btn-primary btn-sm"><i class="fa fa-eye"
                                                                                         aria-hidden="true"></i></a>
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
