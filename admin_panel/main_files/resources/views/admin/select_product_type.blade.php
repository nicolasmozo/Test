@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Select Your Product Type')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Select Your Product Type')}}</h1>
          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset($productItem->script_image) }}" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">{{ $productItem->productitemlangadmin->script_title }}</h5>
                              <p class="card-text">{{ $productItem->productitemlangadmin->script_description }}</p>
                              <a href="{{ route('admin.product.create',['product_type' => 'script']) }}" class="btn btn-primary">{{__('admin.Go to create page')}}</a>
                            </div>
                          </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset($productItem->image_image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $productItem->productitemlangadmin->image_title }}</h5>
                                <p class="card-text">{{ $productItem->productitemlangadmin->image_description }}</p>
                                <a href="{{ route('admin.product.create',['product_type' => 'image']) }}" class="btn btn-primary">{{__('admin.Go to create page')}}</a>
                              </div>
                          </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset($productItem->video_image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $productItem->productitemlangadmin->video_title }}</h5>
                                <p class="card-text">{{ $productItem->productitemlangadmin->video_description }}</p>
                                <a href="{{ route('admin.product.create',['product_type' => 'video']) }}" class="btn btn-primary">{{__('admin.Go to create page')}}</a>
                              </div>
                          </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset($productItem->audio_image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $productItem->productitemlangadmin->audio_title }}</h5>
                                <p class="card-text">{{ $productItem->productitemlangadmin->audio_description }}</p>
                                <a href="{{ route('admin.product.create',['product_type' => 'audio']) }}" class="btn btn-primary">{{__('admin.Go to create page')}}</a>
                              </div>
                          </div>
                    </div>
                </div>
            </div>

        </section>
      </div>
@endsection
