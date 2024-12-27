@extends('admin.layout.app')
@section('content')
@section('page_title','Coupan-List')
@section('coupan','active')
<h1 style="text-align: center;">All Coupan List</h1>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{(session('success'))}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Coupan List</h2>
                            <a href="{{ route('coupan.create')}}" class="btn btn-primary float-end">Add Coupan</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Coupan Title</th>
                                        <th>Coupan Type</th>
                                        <th>Coupan Code</th>
                                        <th>Coupan Value</th>
                                        <th>Cart Value</th>
                                        <th>Maxuse</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupans as $key=> $items)    
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$items->title}}</td>
                                        <td>{{$items->type}}</td>
                                        <td>{{$items->coupan_code}}</td>
                                        <td>{{$items->value}}</td>
                                        <td>{{$items->cart_value}}</td>
                                        <td>{{$items->maxuse}}</td>
                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input toggle-coupan-checkbox" 
                                                    id="status{{ $items->id }}" 
                                                    data-id="{{ $items->id }}" 
                                                    data-type="status" 
                                                           {{ $items->status ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="status{{ $items->id }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('coupan.show',$items->id)}}" class="btn btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('coupan.edit',$items->id)}}" class="btn btn-success">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('coupan.destroy',$items->id)}}" method="POST" class="d-inline" 
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
        $('.toggle-coupan-checkbox').on('change', function() {
            let itemId = $(this).data('id');
            let toggleType = $(this).data('type'); 
            let isChecked = $(this).is(':checked');

            $.ajax({
                url: "{{ route('toggle.coupan') }}",
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
                    console.error('Error updating coupan:', xhr);
                }
            });
        });
    });
</script>
@endsection
