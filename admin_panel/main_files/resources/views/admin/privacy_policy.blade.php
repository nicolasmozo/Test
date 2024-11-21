@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Privacy Policy')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Privacy Policy')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Privacy Policy')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4 ">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.privacy-policy.update',$privacyPolicy->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">

                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.Privacy Policy')}}<span class="text-danger">*</span></label>
                                    <textarea name="privacy_policy" cols="30" rows="10" class="summernote">{!! $privacy_policy_language->privacy_policy !!}</textarea>
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
