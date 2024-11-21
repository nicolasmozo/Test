@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Counter')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Counter')}}</h1>
          </div>

          <div class="section-body">
            <div class="row mt-4">

                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-counter') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                            @php
                                $home1= false;
                                if($setting->selected_theme == 0 || $setting->selected_theme == 1){
                                    $home1 = true;
                                }
                            @endphp


                            <div class="row mt-3">

                                    <div class="col-md-6">

                                        @if (session()->get('admin_lang') == request()->get('lang_code'))
                                        <div class="form-group">
                                            <label>{{__('admin.Item one icon')}}</label>
                                            <div>
                                                <img class="icon_w100" src="{{ asset($counter->counter_icon1) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>{{__('admin.New icon')}} </label>
                                            <input type="file" class="form-control-file" name="counter_icon1">
                                        </div>



                                        <div class="form-group ">
                                            <label>{{__('admin.Counter one quantity')}} <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"  name="counter1_value" value="{{ $counter->counter1_value }}">
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label>{{__('admin.Counter one title')}} <span class="text-danger">*</span></label>
                                            <input type="text" id="counter1_title" class="form-control"  name="counter1_title" value="{{ $counter->counter1_title }}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        @if (session()->get('admin_lang') == request()->get('lang_code'))
                                        <div class="form-group">
                                            <label>{{__('admin.Item two icon')}}</label>
                                            <div>
                                                <img class="icon_w100" src="{{ asset($counter->counter_icon2) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>{{__('admin.New icon')}} </label>
                                            <input type="file" class="form-control-file" name="counter_icon2">
                                        </div>



                                        <div class="form-group">
                                            <label>{{__('admin.Counter two quantity')}} <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"  name="counter2_value" value="{{ $counter->counter2_value }}">
                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <label>{{__('admin.Counter two title')}} <span class="text-danger">*</span></label>
                                            <input type="text" id="counter2_title" class="form-control"  name="counter2_title" value="{{ $counter->counter2_title }}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        @if (session()->get('admin_lang') == request()->get('lang_code'))
                                        <div class="form-group">
                                            <label>{{__('admin.Item three icon')}}</label>
                                            <div>
                                                <img class="icon_w100" src="{{ asset($counter->counter_icon3) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>{{__('admin.New icon')}} </label>
                                            <input type="file" class="form-control-file" name="counter_icon3">
                                        </div>



                                        <div class="form-group">
                                            <label>{{__('admin.Counter three quantity')}} <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"  name="counter3_value" value="{{ $counter->counter3_value }}">
                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <label>{{__('admin.Counter three title')}} <span class="text-danger">*</span></label>
                                            <input type="text" id="counter3_title" class="form-control"  name="counter3_title" value="{{ $counter->counter3_title }}">
                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        @if (session()->get('admin_lang') == request()->get('lang_code'))
                                        <div class="form-group col-12">
                                            <label>{{__('admin.Item four icon')}}</label>
                                            <div>
                                                <img class="icon_w100" src="{{ asset($counter->counter_icon4) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{__('admin.New icon')}} </label>
                                            <input type="file" class="form-control-file" name="counter_icon4">
                                        </div>


                                        <div class="form-group">
                                            <label>{{__('admin.Counter four quantity')}} <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"  name="counter4_value" value="{{ $counter->counter4_value }}">
                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <label>{{__('admin.Counter four title')}} <span class="text-danger">*</span></label>
                                            <input type="text" id="counter4_title" class="form-control"  name="counter4_title" value="{{ $counter->counter4_title }}">
                                        </div>

                                    </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
