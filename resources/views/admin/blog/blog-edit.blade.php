@extends('admin.layout.app')
@section('content')
@section('page_title','Blog-Edit')
      <h1 style="text-align: center;">Add Blog</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Blog</h3>
                            </div>
                            <form action="{{route('blog.update',$blog_edit->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf      
                                <input type="hidden" name="_method" value="PUT">                                                                 
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Blog Title</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="Enter a Blog Title" value="{{$blog_edit->title}}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="desc" id="editor1">
                                                    {!! $blog_edit->desc !!}
                                                </textarea>
                                        @error('desc')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Image Upload</label>
                                        <input type="file" class="form-control" name="image">
                                        @if($blog_edit->image)
                                          <div class="mt-2">
                                             <p>Current Image:</p>
                                               <img src="{{ asset('admin/img/' . $blog_edit->image) }}" alt="blog Image" style="max-height: 100px;">
                                           </div>
                                    @endif
                                     @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputName">Date</label>
                                                <input type="date" class="form-control" name="date"
                                                    placeholder="Button Text" value="{{$blog_edit->date}}">
                                                    @error('date')
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
