@extends('admin.layout.app')
@section('content')
@section('page_title','Category-View')
      <h1 style="text-align: center;">Category View</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <a href="{{route('category.index')}}" class="btn btn-danger">Back</a>
                            </div>
                            <h3>Category Name : 
                                <p class="d-inline text-success"> 
                                    {{$category_view->category_name}} 
                                </p>
                            </h3> 


                            <h3>Slug Name : 
                                <p class="d-inline text-success"> 
                                    {{$category_view->slug_name}} 
                                </p>
                            </h3> 

                            <h3>Image:</h3>
                            <p>
                                <img src="{{ asset('admin/img/' . $category_view->image) }}" alt="Image" style="width: 300px; height:100px;">
                            </p>

                           
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>
@endsection
