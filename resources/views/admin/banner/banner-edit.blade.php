@extends('admin.layout.app')
@section('content')
@section('page_title','Banner-Edit')
      <h1 style="text-align: center;">Add Banner</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Banner</h3>
                            </div>
                            <form action="{{route('banner.update',$banner->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf      
                                <input type="hidden" name="_method" value="PUT">                                                                 
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Banner Title</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="Enter a Banner Title" value="{{$banner->title}}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">Sub Title</label>
                                        <input type="text" class="form-control" name="subtitle"
                                            placeholder="Sub Title" value="{{$banner->subtitle}}">
                                            @error('subtitle')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Image Upload</label>
                                        <input type="file" class="form-control" name="image">
                                        @if($banner->image)
                                          <div class="mt-2">
                                             <p>Current Image:</p>
                                               <img src="{{ asset('admin/img/' . $banner->image) }}" alt="banner Image" style="max-height: 100px;">
                                           </div>
                                    @endif
                                     @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputName">Button Text</label>
                                                <input type="text" class="form-control" name="btn_txt"
                                                    placeholder="Button Text" value="{{$banner->btn_txt}}">
                                                    @error('btn_txt')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputName">Link Text</label>
                                                <input type="text" class="form-control" name="link_txt"
                                                    placeholder="Link Text" value="{{$banner->link_txt}}">
                                                    @error('link_txt')
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
