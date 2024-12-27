@extends('admin.layout.app')
@section('content')
@section('page_title','Banner-Add')
      <h1 style="text-align: center;">Add Banner</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Banner</h3>
                            </div>
                            <form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf                                                                                        
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Banner Title</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="Enter a Title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">Sub Title</label>
                                        <input type="text" class="form-control" name="subtitle"
                                            placeholder="Enter a Sub Title" value="{{ old('subtitle') }}">
                                            @error('subtitle')
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
                                                <label for="exampleInputName">Button Text</label>
                                                <input type="text" class="form-control" name="btn_txt"
                                                    placeholder="thise field is Optional" value="{{ old('btn_txt') }}">
                                                    @error('btn_txt')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputName">Link Text</label>
                                                <input type="text" class="form-control" name="link_txt"
                                                    placeholder="thise field is Optional" value="{{ old('link_txt') }}">
                                                    @error('link_txt')
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
