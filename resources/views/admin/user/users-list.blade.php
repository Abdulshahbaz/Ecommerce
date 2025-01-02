@extends('admin.layout.app')
@section('content')
@section('page_title','User-List')
@section('user','active')
<h1 style="text-align: center;">All User List</h1>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{(session('success'))}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">User List</h2>
                            {{-- <a href="{{ route('user.create')}}" class="btn btn-primary float-end">Add User</a> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ $user->name}}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile }}</td>
                                            <td>
                                                <a href="{{ route('orders.user', $user->id) }}" class="btn btn-info me-2">
                                                    <i class="fas fa-eye"></i>
                                                </a>
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
