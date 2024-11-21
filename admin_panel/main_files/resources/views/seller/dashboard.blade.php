@extends('seller.master_layout')
@section('title')
<title>{{__('admin.Dashboard')}}</title>
@endsection
@section('seller-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Dashboard')}}</h1>
      </div>

      <div class="section-body">

        <div class="row mt-5">

            <div class="col-md-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-newspaper"></i>
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


            <div class="col-md-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-newspaper"></i>
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

            <div class="col-md-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
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
            </div>


            <div class="col-md-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{__('admin.Complete Withdraw')}}</h4>
                    </div>
                    <div class="card-body">
                        {{ $setting->currency_icon }}{{ $complete_withdraw }}
                    </div>
                    </div>
                </div>
            </div>



        </div>


        <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>{{ __('admin.Order Statistics') }}</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a href="javascript:;" id="weeklyReport" class="btn btn-primary">{{ __('admin.Week') }}</a>
                      <a href="javascript:;" id="monthlyReport" class="btn">{{ __('admin.Month') }}</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="myChart" height="120"></canvas>
                  <canvas id="myChartMontly" class="d-none" height="120"></canvas>

                </div>

              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                      <h4>{{ __('admin.Recent Orders') }}</h4>
                      <div class="card-header-action">
                        <a href="{{ route('seller.all-booking') }}" class="btn btn-danger">{{ __('admin.View More') }} <i class="fas fa-chevron-right"></i></a>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th >{{__('admin.Customer')}}</th>
                                    <th >{{__('admin.Amount')}}</th>
                                    <th >{{__('admin.Quantity')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_items as $index => $order_item)
                                    <tr>
                                        <td>{{ $order_item->user->name}}</td>

                                        <td>{{ $setting->currency_icon }}{{ round($order_item->option_price) }}</td>

                                        <td>{{ $order_item->qty }}</td>

                                        <td>

                                          <a href="{{ url('seller/order-show',  ['item_id' => $order_item->id, 'order_id' => $order_item->track_id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
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


  <script src="{{ asset('backend/js/page/chart.min.js') }}"></script>

<script>

    let currency_icon = "{{ Session::get('currency_icon') }}"
    $("#monthlyReport").on("click", function(){
        $(this).addClass('btn-primary')
        $("#weeklyReport").removeClass('btn-primary')
        $("#yearlyReport").removeClass('btn-primary')

        $("#myChart").addClass('d-none')
        $("#myChartMontly").removeClass('d-none')

    })

    $("#weeklyReport").on("click", function(){
        $(this).addClass('btn-primary')
        $("#monthlyReport").removeClass('btn-primary')
        $("#yearlyReport").removeClass('btn-primary')

        $("#myChart").removeClass('d-none')
        $("#myChartMontly").addClass('d-none')

    })


    function loadMonthlyChart(){

        let monthly_lable = @json($monthly_lable);
        monthly_lable = JSON.parse(monthly_lable);

        let monthly_data_for_order = @json($monthly_data_for_order);
        monthly_data_for_order = JSON.parse(monthly_data_for_order);

        let dynamic_label = monthly_lable;

        let dynamic_data_for_booking = monthly_data_for_order;


        var statistics_chart = document.getElementById("myChartMontly").getContext("2d");

        var myChart = new Chart(statistics_chart, {
            type: "line",
            data: {
                labels: dynamic_label,
                datasets: [
                    {
                        label: currency_icon,
                        data: dynamic_data_for_booking,
                        borderWidth: 5,
                        borderColor: "#3A70FF",
                        backgroundColor: "transparent",
                        pointBackgroundColor: "#fff",
                        pointBorderColor: "#3A70FF",
                        pointRadius: 4,
                    }
                ],
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },

                        },
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                color: "#fbfbfb",
                                lineWidth: 2,
                            },
                        },
                    ],
                },
            },
        });

    }


    function loadWeeklyChart(){

        let weekly_lable = @json($weekly_lable);
        weekly_lable = JSON.parse(weekly_lable);



        let weekly_data_for_order = @json($weekly_data_for_order);
        weekly_data_for_order = JSON.parse(weekly_data_for_order);

        let dynamic_label = weekly_lable;

        let dynamic_data_for_booking = weekly_data_for_order;


        var statistics_chart = document.getElementById("myChart").getContext("2d");

        var myChart = new Chart(statistics_chart, {
            type: "line",
            data: {
                labels: dynamic_label,
                datasets: [
                    {
                        label: currency_icon,
                        data: dynamic_data_for_booking,
                        borderWidth: 5,
                        borderColor: "#3A70FF",
                        backgroundColor: "transparent",
                        pointBackgroundColor: "#fff",
                        pointBorderColor: "#3A70FF",
                        pointRadius: 4,
                    }
                ],
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },

                        },
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                color: "#fbfbfb",
                                lineWidth: 2,
                            },
                        },
                    ],
                },
            },
        });

    }

    loadWeeklyChart()
    loadMonthlyChart()

</script>


@endsection
