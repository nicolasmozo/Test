@extends('seller.master_layout')
@section('title')
<title>{{__('admin.My withdraw')}}</title>
@endsection
@section('seller-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.My withdraw')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('seller.my-withdraw.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.My withdraw')}}</a>

            <div class="row mt-5">
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
                    {{ $total_balance }}
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



            <div class="col-md-4">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
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

          </div>


            <div class="row mt-4">
                <div class="col-6">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('seller.my-withdraw.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{__('admin.Withdraw Method')}}</label>
                            <select name="method_id" id="method_id" class="form-control">
                                <option value="">{{__('admin.Select Method')}}</option>
                                @foreach ($methods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">{{__('admin.Withdraw Amount')}}</label>
                            <input type="text" class="form-control" name="withdraw_amount">
                        </div>


                        <div class="form-group">
                            <label for="">{{__('admin.Account Information')}}</label>
                            <textarea name="account_info" id="" cols="30" rows="10" class="form-control text-area-5"></textarea>
                        </div>

                        <button class="btn btn-primary" type="submit">{{__('admin.Send Request')}}</button>
                        </form>
                    </div>
                  </div>
                </div>

                <div class="col-6 d-none" id="method_des_box">
                    <div class="card">
                        <div class="card-body" id="method_des">

                        </div>
                    </div>
                </div>
          </div>
        </section>
      </div>



<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        $("#method_id").on('change', function(){
            var methodId = $(this).val();
            $.ajax({
                type:"get",
                url:"{{url('/seller/get-withdraw-account-info/')}}"+"/"+methodId,
                success:function(response){
                   $("#method_des").html(response)
                   $("#method_des_box").removeClass('d-none')
                },
                error:function(err){}
            })

            if(!methodId){
                $("#method_des_box").addClass('d-none')
            }

        })
    });

    })(jQuery);
</script>
@endsection
