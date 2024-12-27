@extends('admin.layout.app')
@section('content')
@section('page_title', 'Product-Edit')
<h1 style="text-align: center;">Product Update</h1>
<section class="content">
    <div class="container-fluid">
        <div class="row" style="justify-content: center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product</h3>
                    </div>
                    <form action="{{ route('product.update', $product_edit->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Category Name</label>
                                    <select class="form-control" name="cat_id">
                                        <option selected="selected">Select Category</option>
                                        @foreach ($category_name as $catgories)
                                            <option value="{{ $catgories->id }}"
                                                {{ $product_edit->category_id == $catgories->id ? 'Selected' : '' }}>
                                                {{ $catgories->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputName">Product Name</label>
                                    <input type="text" class="form-control" name="product_name"
                                        placeholder="Enter a Product Name" value="{{ $product_edit->name }}">
                                    @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" id="editor">
                                                {{ $product_edit->short_desc }}
                                            </textarea>
                                    @error('short_desc')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="desc" id="editor1">
                                                {{ $product_edit->desc }}
                                            </textarea>
                                    @error('desc')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputName">MRP</label>
                                    <input type="text" class="form-control" name="mrp"
                                        placeholder=" Enter a MRP Amount" value="{{ $product_edit->mrp }}">
                                    @error('mrp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputName">Price</label>
                                    <input type="text" class="form-control" name="price"
                                        placeholder=" Enter a Price" value="{{ $product_edit->price }}">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputName">Slug Name</label>
                                    <input type="text" class="form-control" name="slug_name"
                                        placeholder=" Enter a Slug Name" value="{{ $product_edit->slug }}">
                                    @error('slug_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Image Upload</label>
                                    <input type="file" class="form-control" name="image">
                                    @if($product_edit->image)
                                      <div class="mt-2">
                                         <p>Current Image:</p>
                                           <img src="{{ asset('admin/img/' . $product_edit->image) }}" alt="Category Image" style="max-height: 100px;">
                                       </div>
                                @endif
                                 @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
