@extends('user.layout.app')
@section('content')
@section('page_title','Order')
@section('order','active')
<h1 style="text-align: center;">All Orders List</h1>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{(session('success'))}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Orders List</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                               <tbody>
                                    @foreach ($user_order as $key=> $items)    
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$items->fname}} {{$items->lname}}</td>
                                        <td>{{$items->email}}</td>
                                        <td>{{$items->phone}}</td>
                                        <td>{{number_format($items->subtotal,2)}}</td>
                                        <td>{{number_format($items->total,2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection