@extends('seller.master_layout')
@section('title')
<title>{{__('admin.Create Ticket')}}</title>
@endsection
@section('seller-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create Ticket')}}</h1>
          </div>

          <div class="section-body">
            <a class="btn btn-primary" href="{{ route('seller.ticket') }}"> <i class="fa fa-list" aria-hidden="true"></i> {{__('admin.Ticket List')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('seller.store-new-ticket') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">{{__('admin.Select Order')}} <span class="text-danger">*</span></label>
                                <select name="order_id" id="" class="form-control select2">
                                    <option value="">{{__('admin.Select')}}</option>
                                    @foreach ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->order->order_id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Subject')}} <span class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Message')}} <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                            </div>

                            <button class="btn btn-primary">{{__('admin.Save')}}</button>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>




@endsection
