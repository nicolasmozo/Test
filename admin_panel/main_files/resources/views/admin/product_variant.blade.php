@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Product')}}</title>
@endsection
@section('admin-content')
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
                      <li class="nav-item"><a href="{{ route('admin.product.edit',['product' => $product->id, 'lang_code' => 'en']) }}" class="nav-link">{{__('admin.Basic Information')}}</a></li>

                      <li class="nav-item"><a href="{{ route('admin.product-variant', $product->id) }}" class="nav-link active">{{__('admin.Variants of Service')}}</a></li>

                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                  <div class="card" id="settings-card">
                    <div class="card-header">
                      <h4>{{__('admin.Service List')}}</h4>

                      <button class="btn btn-primary variant-btn" data-toggle="modal" data-target="#addNewVariant"><i class="fa fa-plus" aria-hidden="true"></i> {{__('admin.Add new service')}}</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th>{{__('admin.Service')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_variants as $index => $product_variant)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ html_decode($product_variant->variant_name) }}</td>

                                        <td>
                                            <a href="javascript:;" data-toggle="modal" data-target="#editVariant-{{ $product_variant->id }}" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> </a>

                                            <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" class="btn btn-danger btn-sm" onclick="deleteData({{ $product_variant->id }})"> <i class="fas fa-trash"></i> </a>
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

        </section>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="addNewVariant" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Create new service')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.store-product-variant', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="">{{__('admin.Image')}} <span class="text-danger">*</span></label>
                                <input type="file" name="file_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Service name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="variant_name" class="form-control" autocomplete="off">
                            </div>

                            <div class="row" id="variant_option_box">
                                <div class="col-12 form-group">
                                    <label for="">{{ __('admin.Options') }}</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="titles[]" autocomplete="off" placeholder="Title">
                                        <input type="text" class="form-control" name="prices[]" autocomplete="off" placeholder="Price">

                                        <div class="input-group-append add_new_options">
                                            <span class="input-group-text" id=""><i class="fa fa-plus" aria-hidden="true"> {{ __('admin.Add') }}</i>  </span>
                                        </div>

                                      </div>
                                </div>

                            </div>

                            <button class="btn btn-primary mt-2">{{__('admin.Save')}}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
      </div>

    @foreach ($product_variants as $product_variant)
    <div class="modal fade" id="editVariant-{{ $product_variant->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Edit Service')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.update-product-variant', $product_variant->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="">{{__('admin.Existing Image')}}</label>
                                <div class="variant_image">
                                    <img src="{{ asset($product_variant->file_name) }}" alt="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="">{{__('admin.Image')}}</label>
                                <input type="file" name="file_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Service name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="variant_name" class="form-control" autocomplete="off" value="{{ $product_variant->variant_name }}">
                            </div>

                            <div class="row variant_option_box">
                                @php
                                    $varaint_options = json_decode($product_variant->options)
                                @endphp

                                @foreach ($varaint_options as $varaint_option)
                                    <div class="col-12 form-group">
                                        <label for="">{{ __('admin.Options') }}</label>
                                        <div class="input-group">

                                            <input type="text" class="form-control" name="titles[]" autocomplete="off" placeholder="Title" value="{{ $varaint_option->title }}">
                                            <input type="text" class="form-control" name="prices[]" autocomplete="off" placeholder="Price" value="{{ $varaint_option->price }}">

                                            <div class="input-group-append remove_new_options">
                                                <span class="input-group-text" id=""><i class="fa fa-trash" aria-hidden="true"> {{ __('admin.Remove') }}</i>  </span>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-12 form-group">
                                    <label for="">{{ __('admin.Options') }}</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="titles[]" autocomplete="off" placeholder="Title">
                                        <input type="text" class="form-control" name="prices[]" autocomplete="off" placeholder="Price">

                                        <div class="input-group-append add_new_options_in_edit">
                                            <span class="input-group-text" id=""><i class="fa fa-plus" aria-hidden="true"> {{ __('admin.Add') }}</i>  </span>
                                        </div>

                                      </div>
                                </div>



                            </div>


                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
      </div>
    @endforeach




<script>

    (function($) {
        "use strict";
        var specification = true;
        $(document).ready(function () {

            $(".add_new_options").on("click", function(e){

                var append_code = `<div class="col-12 form-group">
                                    <label for="">{{ __('admin.Options') }}</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="titles[]" autocomplete="off" placeholder="Title">
                                        <input type="text" class="form-control" name="prices[]" autocomplete="off" placeholder="Price">

                                        <div class="input-group-append remove_new_options">
                                            <span class="input-group-text" id=""><i class="fa fa-trash" aria-hidden="true"> {{ __('admin.Remove') }}</i>  </span>
                                        </div>

                                      </div>
                                </div>`;

                $("#variant_option_box").append(append_code)

            })


            $(".add_new_options_in_edit").on("click", function(e){

                var append_code = `<div class="col-12 form-group">
                                    <label for="">{{ __('admin.Options') }}</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="titles[]" autocomplete="off" placeholder="Title">
                                        <input type="text" class="form-control" name="prices[]" autocomplete="off" placeholder="Price">

                                        <div class="input-group-append remove_new_options">
                                            <span class="input-group-text" id=""><i class="fa fa-trash" aria-hidden="true"> {{ __('admin.Remove') }}</i>  </span>
                                        </div>

                                      </div>
                                </div>`;

                    $(this).closest('.variant_option_box').append(append_code)


            })





            $(document).on('click', '.remove_new_options', function () {
                $(this).closest('.form-group').remove();
            });

        });
    })(jQuery);


    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/delete-product-variant/") }}'+"/"+id)
    }



</script>
@endsection
