@extends('admin.layout.app')
@section('content')
@section('page_title', 'Product-Add')

<h1 style="text-align: center;">Add Product</h1>
<section class="content">
    <div class="container-fluid">
        <div class="row" style="justify-content: center">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product</h3>
                    </div>
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                        <label>Category Name</label>
                                        <select class="form-control" name="cat_id">
                                          <option selected="selected">Select Category</option>
                                          @foreach ($category_names as $items)
                                          <option value="{{$items->id}}">{{$items->category_name}}</option>
                                          @endforeach
                                        </select>
                                    @error('product_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputName">Product Name</label>
                                    <input type="text" class="form-control" name="product_name"
                                        placeholder="Enter a Product Name" value="{{ old('product_name') }}">
                                    @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputName">Slug Name</label>
                                    <input type="text" class="form-control" name="slug_name"
                                        placeholder=" Enter a Slug Name" value="{{ old('slug_name') }}">
                                    @error('slug_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputName">Image</label>
                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" id="editor"></textarea>
                                    @error('short_desc')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="desc" id="editor1"></textarea>
                                    @error('desc')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputName">MRP</label>
                                    <input type="text" class="form-control" name="mrp"
                                        placeholder=" Enter a MRP Amount" value="{{ old('mrp') }}">
                                    @error('mrp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputName">Price</label>
                                    <input type="text" class="form-control" name="price"
                                        placeholder=" Enter a Price" value="{{ old('price') }}">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
