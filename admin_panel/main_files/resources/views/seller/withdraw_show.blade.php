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
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
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
                                <td width="50%">
                                    {{ $setting->currency_icon }}{{ sprintf('%.2f',($withdraw->total_amount - $withdraw->withdraw_amount)) }}
                                </td>
                            </tr>

                            <tr>
                                <td width="50%">{{__('admin.Total amount')}}</td>
                                <td width="50%">
                                    {{ $setting->currency_icon }}{{ sprintf('%.2f',$withdraw->total_amount) }}
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('admin.Withdraw amount')}}</td>
                                <td width="50%">
                                    {{ $setting->currency_icon }}{{ sprintf('%.2f',$withdraw->withdraw_amount) }}
                                </td>
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
                            @if ($withdraw->status==1)
                                <tr>
                                    <td width="50%">{{__('admin.Approved Date')}}</td>
                                    <td width="50%">{{ $withdraw->approved_date }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td width="50%">{{__('admin.Account Information')}}</td>
                                <td width="50%">
                                    {!! clean(nl2br($withdraw->account_info)) !!}
                                </td>
                            </tr>
                            @if($withdraw->feedback != null)
                                <tr>
                                    <td width="50%">{{__('admin.Reject Reason')}}</td>
                                    <td width="50%">
                                        {!! clean(nl2br($withdraw->feedback)) !!}
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>


@endsection
