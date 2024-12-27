@extends('admin.layout.app')
@section('content')
@section('page_title','Order-List')
@section('order','active')
<h1 style="text-align: center;">All Order List</h1>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{(session('success'))}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Order List</h2>
                            {{-- <a href="{{ route('orders.create')}}" class="btn btn-primary float-end">Add Order</a> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Phone</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th>Transaction ID</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->fname }} {{ $order->lname }}</td>
                                            {{-- <td>{{ $order->email }}</td> --}}
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ number_format($order->subtotal, 2) }}</td>
                                            <td>{{ number_format($order->total, 2) }}</td>
                                            <td>{{ ucfirst($order->payment_status) }}</td>
                                            <td>{{ $order->transaction_id }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info me-2">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline-block" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Delete This Record')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
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
