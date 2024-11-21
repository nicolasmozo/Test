@extends('admin.master_layout')
@section('title')
<title>{{ __('admin.Topbar Contact Info') }}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ __('admin.Topbar Contact Info') }}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{ __('admin.Topbar Contact Info') }}</div>
            </div>
          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-header-info') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">{{__('admin.Phone')}}</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $setting->topbar_phone }}">

                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Phone')}}</label>
                                        <input type="email" class="form-control" name="email" value="{{ $setting->topbar_email }}">

                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Address')}}</label>
                                        <input type="text" class="form-control" name="address" value="{{ $setting->topbar_address }}">

                                    </div>

                                    <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>
      </div>


@endsection
