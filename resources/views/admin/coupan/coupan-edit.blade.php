@extends('admin.layout.app')
@section('content')
@section('page_title','Coupan-Edit')
      <h1 style="text-align: center;">Add Coupan</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Coupan</h3>
                            </div>
                            <form action="{{route('coupan.update',$coupan->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf       
                                <input  type="hidden" name="_method" value="PUT">                                                                                 
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Coupan Title</label>
                                        <input type="text" class="form-control" name="title"
                                             value="{{$coupan->title}}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Coupan Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option desiable>Select Coupon Type</option>
                                            <option value="fixed" {{ old('type', $coupan->type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                            <option value="percent" {{ old('type', $coupan->type) == 'percent' ? 'selected' : '' }}>Percent</option>
                                        </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Coupan Code</label>
                                        <input type="text" class="form-control" name="coupan_code"
                                             value="{{$coupan->coupan_code}}">
                                            @error('coupan_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="exampleInputName">Coupan Value</label>
                                        <input type="text" class="form-control" name="value"
                                             value="{{$coupan->value}}">
                                            @error('value')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Cart Value</label>
                                        <input type="text" class="form-control" name="cart_value"
                                             value="{{$coupan->cart_value}}">
                                            @error('cart_value')
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
