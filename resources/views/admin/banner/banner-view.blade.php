@extends('admin.layout.app')
@section('content')
@section('page_title','Banner-View')
      <h1 style="text-align: center;">Banner View</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <a href="{{route('banner.index')}}" class="btn btn-danger">Back</a>
                            </div>
                            <h3>Banner Title : 
                                <p class="d-inline text-success"> 
                                    {{$banner_view->title  ?? 'Null'}} 
                                </p>
                            </h3> 


                            <h3>Sub Title : 
                                <p class="d-inline text-success"> 
                                    {{$banner_view->subtitle ?? 'Null'}} 
                                </p>
                            </h3> 

                            <h3>Image:</h3>
                            <p>
                                <img src="{{ asset('admin/img/' .$banner_view->image) }}" alt="Image" style="width: 300px; height:100px;">
                            </p>

                            <h3>Button Text : 
                                <p class="d-inline text-success"> 
                                    {{$banner_view->btn_txt ?? 'Null'}} 
                                </p>
                            </h3> 

                            <h3>Link Text : 
                                <p class="d-inline text-success"> 
                                    {{$banner_view->link_txt ?? 'Null'}} 
                                </p>
                            </h3> 
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>
@endsection
