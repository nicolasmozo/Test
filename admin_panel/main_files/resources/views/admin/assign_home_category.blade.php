@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Assign Homepage Category')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Assign Homepage Category')}}</h1>
          </div>

          <div class="section-body">

            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-assign-home-category') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="form-group col-12">
                                    <label>{{__('admin.Category One')}} <span class="text-danger">*</span></label>
                                    <select name="category_one" class="form-control">
                                        @foreach ($categories as $category)
                                            <option {{ $home_category->category_one == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Trending Categories')}} <span class="text-danger">*</span></label>
                                    <select name="trending_categories[]" class="form-control select2" multiple>
                                        @foreach ($categories as $category)
                                            <option {{ in_array($category->id,  json_decode($home_category->trending_categories)) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Category Three')}} <span class="text-danger">*</span></label>
                                    <select name="category_three" class="form-control">
                                        @foreach ($categories as $category)
                                            <option {{ $home_category->category_three == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-group col-12">
                                    <label>{{__('admin.Category Four')}} <span class="text-danger">*</span></label>
                                    <select name="category_four" class="form-control">
                                        @foreach ($categories as $category)
                                            <option {{ $home_category->category_four == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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
