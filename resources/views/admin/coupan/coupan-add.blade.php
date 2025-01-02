@extends('admin.layout.app')
@section('content')
@section('page_title','Coupan-Add')
      <h1 style="text-align: center;">Add Coupan</h1>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="justify-content: center">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Coupan</h3>
                            </div>
                            <form action="{{route('coupan.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf                                                                                        
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName">Coupan Title</label>
                                        <input type="text" class="form-control" name="coupan_title"
                                            placeholder="Enter a Coupan "  value="{{ old('coupan_title') }}">
                                    @error('coupan_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">Coupan Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option desiable>Select Coupon Type</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Coupan Code</label>
                                        <input type="text" class="form-control" name="coupan_code"
                                        style="text-transform: uppercase;"  placeholder="Enter a Coupan Code"  value="{{ old('coupan_code') }}">
                                            @error('coupan_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Coupan Value</label>
                                        <input type="text" class="form-control" name="coupan_value"
                                            placeholder="Enter a Coupan value"  value="{{ old('coupan_value') }}">
                                            @error('coupan_value')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Cart Value</label>
                                        <input type="text" class="form-control" name="cart_value"
                                            placeholder=" Enter a cart Value"  value="{{ old('cart_value') }}">
                                            @error('cart_value')
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
