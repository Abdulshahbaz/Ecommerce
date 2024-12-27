@extends('admin.layout.app')
@section('content')
@section('page_title','Dashboard')
@section('dashboard','active')
<section class="content-header">
  <div class="container-fluid">
      <div class="row">
          <!-- /.col -->
          <div class="col-md-3">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Products</span>
                      <span class="info-box-number">{{$all_products_count}}</span>
                  </div>
                  <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Sales</span>
                      <span class="info-box-number">{{$sales_products_count}}</span>
                  </div>
                  <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Users</span>
                      <span class="info-box-number">{{$all_users_count}}</span>
                  </div>
                  <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->
  </div>
</section>

@endsection