@extends('admin.master_layout')
@section('title')
<title>{{__('admin.FAQ')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit FAQ')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item active"><a href="{{ route('admin.faq.index') }}">{{__('admin.FAQ')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Edit FAQ')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.faq.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.FAQ')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="h3 mb-3 text-gray-800">{{__('admin.Language')}}</h3>
                      <hr>
                      <div class="lang_list_top">
                          <ul class="lang_list">
                              @foreach ($languages as $language)
                              <li><a href="{{ route('admin.faq.edit', ['faq' => $faq->id, 'lang_code' => $language->lang_code]) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
                              @endforeach
                          </ul>
                      </div>

                      <div class="alert alert-danger mt-2" role="alert">
                          @php
                              $current_language = App\Models\Language::where('lang_code', request()->get('lang_code'))->first();
                          @endphp
                          <p>{{__('admin.Your editing mode')}} : <b>{{ $current_language->lang_name }}</b></p>
                      </div>
                    </div>
                  </div>
              </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.faq.update',$faq->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.Question')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="question" class="form-control"  name="question" value="{{ $faq_language->question }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Answer')}} <span class="text-danger">*</span></label>
                                    <textarea name="answer" id="" cols="30" rows="10" class="summernote">{{ $faq_language->answer }}</textarea>
                                </div>
                                @if(session()->get('admin_lang') == request()->get('lang_code'))
                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option {{ $faq->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                        <option {{ $faq->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                    </select>
                                </div>
                                @endif
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
