@extends('admin.layout.app')
@section('content')
@section('page_title','Blog-View')
      <h1 style="text-align: center;">Blog View</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <a href="{{route('blog.index')}}" class="btn btn-danger">Back</a>
                            </div>
                            <h3>Blog Title : 
                                <p class="d-inline text-success"> 
                                    {{$blog_view->title  ?? 'Null'}} 
                                </p>
                            </h3> 


                            <h3>Sub Title : 
                                <p class="d-inline text-success"> 
                                    {!!$blog_view->desc ?? 'Null' !!} 
                                </p>
                            </h3> 

                            <h3>Image:</h3>
                            <p>
                                <img src="{{ asset('admin/img/' .$blog_view->image) }}" alt="Image" style="width: 300px; height:100px;">
                            </p>

                            <h3>Button Text : 
                                <p class="d-inline text-success"> 
                                    {{$blog_view->date ?? 'Null'}} 
                                </p>
                            </h3> 

                        </div>
                       
                    </div>
                </div>
            </div>
        </section>
@endsection
