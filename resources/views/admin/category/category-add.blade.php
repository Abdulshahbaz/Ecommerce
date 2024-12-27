@extends('admin.layout.app')
@section('content')
@section('page_title','Category-Add')
      <h1 style="text-align: center;">Add Category</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Category</h3>
                            </div>
                            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf                                                                                        
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Category_Name</label>
                                        <input type="text" class="form-control" name="category_name"
                                            placeholder="Enter a Category Name" value="{{ old('category_name') }}">
                                    @error('category_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">Slug Name</label>
                                        <input type="text" class="form-control" name="slug_name"
                                            placeholder="Slug Name" value="{{ old('slug_name') }}">
                                            @error('slug_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Image Upload</label>
                                        <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                     @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
