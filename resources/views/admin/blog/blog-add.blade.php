@extends('admin.layout.app')
@section('content')
@section('page_title','Blog-Add')
      <h1 style="text-align: center;">Add Blog</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Blog</h3>
                            </div>
                            <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf                                                                                        
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Blog Title</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="Enter a Title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="desc" id="editor1"></textarea>
                                        @error('desc')
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

                                            <div class="form-group">
                                                <label for="exampleInputName">Date</label>
                                                <input type="date" class="form-control" name="date"
                                                 value="{{ old('date') }}">
                                                    @error('date')
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
