@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Terms And Conditions')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Terms And Conditions')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Terms And Conditions')}}</div>
            </div>
          </div>

            <div class="section-body">
              <div class="row mt-4">

                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.terms-and-condition.update',$termsAndCondition->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.Terms And Conditions')}}<span class="text-danger">*</span></label>
                                    <textarea name="terms_and_condition" cols="30" rows="10" class="summernote">{!! $terms_condition_language->terms_and_condition !!}</textarea>
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
