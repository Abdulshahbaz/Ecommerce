@extends('admin.layout.app')
@section('content')
@section('page_title','Category-Edit')
      <h1 style="text-align: center;">Add Category</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Category</h3>
                            </div>
                            <form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf      
                                <input type="hidden" name="_method" value="PUT">                                                                 
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Category_Name</label>
                                        <input type="text" class="form-control" name="category_name"
                                            placeholder="Enter a Category Name" value="{{$category->category_name}}">
                                    @error('category_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">Slug Name</label>
                                        <input type="text" class="form-control" name="slug_name"
                                            placeholder="Slug Name" value="{{$category->slug_name}}">
                                            @error('slug_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Image Upload</label>
                                        <input type="file" class="form-control" name="image">
                                        @if($category->image)
                                          <div class="mt-2">
                                             <p>Current Image:</p>
                                               <img src="{{ asset('admin/img/' . $category->image) }}" alt="Category Image" style="max-height: 100px;">
                                           </div>
                                    @endif
                                     @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
