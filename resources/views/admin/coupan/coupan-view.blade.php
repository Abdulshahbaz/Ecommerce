@extends('admin.layout.app')
@section('content')
@section('page_title','Coupan-View')
      <h1 style="text-align: center;">Coupan View</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <a href="{{route('coupan.index')}}" class="btn btn-danger">Back</a>
                            </div>
                            <h3>Coupan Title : 
                                <p class="d-inline text-success"> 
                                    {{$coupan_view->title}} 
                                </p>
                            </h3> 

                            <h3>Coupan Type : 
                                <p class="d-inline text-success"> 
                                    {{$coupan_view->type}} 
                                </p>
                            </h3> 

                            <h3>Coupan Code : 
                                <p class="d-inline text-success"> 
                                    {{$coupan_view->coupan_code}} 
                                </p>
                            </h3> 
                            <h3>Coupan Value : 
                                <p class="d-inline text-success"> 
                                    {{$coupan_view->value}} 
                                </p>
                            </h3> 
                            <h3>Cart Value : 
                                <p class="d-inline text-success"> 
                                    {{$coupan_view->cart_value}} 
                                </p>
                            </h3> 
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>
@endsection
