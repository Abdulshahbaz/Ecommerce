@extends('admin.layout.app')
@section('content')
@section('page_title','Category-List')
@section('category','active')
<h1 style="text-align: center;">All Category List</h1>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{(session('success'))}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Category List</h2>
                            <a href="{{ route('category.create')}}" class="btn btn-primary float-end">Add Category</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category Name</th>
                                        <th>Slug Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorys as $key=> $items)    
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$items->category_name}}</td>
                                        <td>{{$items->slug_name}}</td>
                                        <td>
                                            <img src="{{ asset('admin/img/' . $items->image) }}" alt="Image" style="width: 100px; height:50px;">
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input toggle-category-checkbox" 
                                                    id="status{{ $items->id }}" 
                                                    data-id="{{ $items->id }}" 
                                                    data-type="status" 
                                                           {{ $items->status ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="status{{ $items->id }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('category.show',$items->id)}}" class="btn btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('category.edit',$items->id)}}" class="btn btn-success">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('category.destroy',$items->id)}}" method="POST" class="d-inline" 
                                                    enctype="multipart/form-data">@csrf @method('Delete')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Delete Thise Record')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-category-checkbox').on('change', function() {
                let itemId = $(this).data('id');
                let toggleType = $(this).data('type'); 
                let isChecked = $(this).is(':checked');
    
                $.ajax({
                    url: "{{ route('toggle.category') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: itemId,
                        toggle_type: toggleType,
                        value: isChecked ? 1 : 0
                    },
                    success: function(response) {
                        console.log(response.message); 
                    },
                    error: function(xhr) {
                        console.error('Error updating category:', xhr);
                    }
                });
            });
        });
    </script>
@endsection