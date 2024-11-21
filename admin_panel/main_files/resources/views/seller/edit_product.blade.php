@extends('seller.master_layout')
@section('title')
<title>{{__('admin.Edit Product')}}</title>
@endsection
@section('seller-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Product')}}</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item"><a href="{{ route('seller.product.edit',['product' => $product->id, 'lang_code' => 'en']) }}" class="nav-link active">{{__('admin.Basic Information')}}</a></li>

                      <li class="nav-item"><a href="{{ route('seller.product-variant', $product->id) }}" class="nav-link">{{__('admin.Variants of Service')}}</a></li>

                    </ul>
                  </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                      <h3 class="h3 mb-3 text-gray-800">{{__('admin.Language')}}</h3>
                      <hr>
                      <ul class="lang_list">
                          @foreach ($languages as $language)
                          <li><a href="{{ route('seller.product.edit',['product' => $product->id, 'lang_code' => $language->lang_code]) }}"><i class="fas fa-edit"></i> {{ $language->lang_name }}</a></li>
                          @endforeach
                      </ul>

                      <div class="alert alert-danger" role="alert">
                          @php
                              $current_language = App\Models\Language::where('lang_code', request()->get('lang_code'))->first();
                          @endphp
                          <p>{{__('admin.Your editing mode')}} : <b>{{ $current_language->lang_name }}</b></p>
                      </div>
                     </div>
                   </div>
              </div>
              <div class="col-md-9">
                  <div class="card" id="settings-card">
                    <div class="card-header">
                      <h4>{{__('admin.Basic Information')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seller.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                @if (session()->get('admin_lang') == request()->get('lang_code'))
                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing thumbnail')}}</label>
                                    <div>
                                        <img class="w_200" src="{{ asset($product->thumbnail_image) }}" alt="">
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Thumbnail Image')}}</label>
                                    <input type="file" class="form-control-file"  name="thumb_image">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Category')}} <span class="text-danger">*</span></label>
                                    <select name="category" class="form-control select2" id="category">
                                        <option value="">{{__('admin.Select Category')}}</option>
                                        @foreach ($categories as $category)
                                            <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->catlangadmin->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ html_decode($product_language->name) }}">
                                    <input type="hidden" name="lang_code" value="{{ request()->get('lang_code') }}">
                                </div>

                                @if (session()->get('admin_lang') == request()->get('lang_code'))

                                <div class="form-group col-12">
                                    <label>{{__('admin.Regular price')}} ({{__('admin.USD')}}) <span class="text-danger">* </span></label>
                                   <input type="text" class="form-control" name="regular_price" value="{{ html_decode($product->regular_price) }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Offer price')}} ({{__('admin.USD')}})</label>
                                   <input type="text" class="form-control" name="offer_price" value="{{ html_decode($product->offer_price) }}">
                                </div>


                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.Short Description')}} <span class="text-danger">*</span></label>
                                    <textarea name="short_description" id="" cols="30" rows="10" class="form-control text-area-5">{{ html_decode($product_language->short_description) }}</textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>
                                    <textarea name="description" id="" cols="30" rows="10" class="summernote">{{ html_decode($product_language->description) }}</textarea>
                                </div>



                                @if (session()->get('admin_lang') == request()->get('lang_code'))
                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option {{ $product->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                        <option {{ $product->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
                                    </select>
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('admin.Tags')}} ({{__('admin.Press the comma for new tag')}})</label><br>
                                    <input type="text" class="form-control tags" name="tags" value="{{ html_decode($product->tags) }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.SEO Title')}}</label>
                                   <input type="text" class="form-control" name="seo_title" value="{{ html_decode($product->seo_title) }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.SEO Description')}}</label>
                                    <textarea name="seo_description" id="" cols="30" rows="10" class="form-control text-area-5">{{ html_decode($product->seo_description) }}</textarea>
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
  		    </div>

        </section>
      </div>

<script>
    (function($) {
        "use strict";
        var specification = true;
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })


        });
    })(jQuery);

    function convertToSlug(Text){
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-');
    }


</script>


@endsection
