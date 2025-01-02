@extends('user.layout.app')
@section('content')
@section('page_title', 'Profile')
@section('profile', 'active')
<h1 style="text-align: center;">Update User Profile</h1>
<section class="content">
    <div class="container-fluid">
        <div class="row" style="justify-content: center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Banner</h3>
                    </div>
                    <form action="{{route('user.profile.update',$user_profile->id)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter a Banner Name" value="{{$user_profile->name}}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter a Email"
                                value="{{$user_profile->email}}" readonly>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName">Mobile</label>
                                <input type="text" class="form-control" name="mobile" placeholder="Button Text"
                                value="{{$user_profile->mobile}}">
                                @error('mobile')
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
