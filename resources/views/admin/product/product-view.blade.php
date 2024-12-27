@extends('admin.layout.app')
@section('content')
@section('page_title', 'Product-View')
<h1 style="text-align: center;">Product View</h1>
<section class="content">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Product Details</span>
                </div>
                <div class="card-body product-details">
                    <h6 class="text-success"><strong class="text-dark">Category Name:</strong>
                        {{ $product_view->category->category_name }}</h6>

                    <h6 class="text-success"><strong class="text-dark">Product Name:</strong>
                        {{ $product_view->name }}</h6>

                    <h6 class="text-success"><strong class="text-dark">Slug Name:</strong>
                        {{ $product_view->slug }}</h6>

                    <h6 class="text-success"><strong class="text-dark">Short Description:</strong>
                        {!! $product_view->short_desc !!}</h6>

                    <h6 class="text-success"><strong class="text-dark">Description:</strong>
                        {!! $product_view->desc !!}</h6>

                    <h6 class="text-success"><strong class="text-dark">Product MRP:</strong>
                        {{ $product_view->mrp }}</h6>

                    <h6 class="text-success"><strong class="text-dark">Product Price:</strong>
                        {{ $product_view->price }}</h6>

                    <h6 class="text-success"><strong class="text-dark">Image:</strong>
                        <img src="{{ asset('admin/img/' . $product_view->image) }}" alt="Image"
                            style="width: 300px; height:100px;">
                    </h6>

                    <a href="{{ route('product.index') }}" class="btn btn-danger btn-sm float-start">Back</a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
