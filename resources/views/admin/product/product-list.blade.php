@extends('admin.layout.app')
@section('content')
@section('page_title', 'Product-List')
@section('product', 'active')
<h1 style="text-align: center;">All Product List</h1>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: "{{ session('success') }}",
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Product List</h2>
                        <a href="{{ route('product.create') }}" class="btn btn-primary float-end">Add product</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table  responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Slug Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Latest</th>
                                    <th>Top-Rated</th>
                                    <th>Review</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $items)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $items->category->category_name }}</td>
                                        <td>{{ $items->name }}</td>
                                        <td>{{ $items->slug }}</td>
                                        <td>{{ $items->price }}</td>

                                        <td>
                                            <img src="{{ asset('admin/img/' . $items->image) }}" alt="Image"
                                                style="width: 80px; height:50px;">
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox"
                                                        class="custom-control-input toggle-product-checkbox"
                                                        id="status{{ $items->id }}" data-id="{{ $items->id }}"
                                                        data-type="status" {{ $items->status ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="status{{ $items->id }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox"
                                                        class="custom-control-input toggle-product-checkbox"
                                                        id="latestProduct{{ $items->id }}"
                                                        data-id="{{ $items->id }}" data-type="latest_product"
                                                        {{ $items->latest_product ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="latestProduct{{ $items->id }}"></label>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox"
                                                        class="custom-control-input toggle-product-checkbox"
                                                        id="topRatedProduct{{ $items->id }}"
                                                        data-id="{{ $items->id }}" data-type="top_rated_product"
                                                        {{ $items->top_rated_product ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="topRatedProduct{{ $items->id }}"></label>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox"
                                                        class="custom-control-input toggle-product-checkbox"
                                                        id="reviewProduct{{ $items->id }}"
                                                        data-id="{{ $items->id }}" data-type="review_product"
                                                        {{ $items->review_product ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="reviewProduct{{ $items->id }}"></label>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="{{ route('product.show', $items->id) }}"
                                                class="btn btn-info btn-sm d-inline"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('product.edit', $items->id) }}"
                                                class="btn btn-success btn-sm d-inline"> <i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('product.destroy', $items->id) }}" method="POST"
                                                class="d-inline" enctype="multipart/form-data">
                                                @csrf
                                                @method('Delete')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are You Sure Delete Thise Record')">
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
        $('.toggle-product-checkbox').on('change', function() {
            let itemId = $(this).data('id');
            let toggleType = $(this).data(
            'type'); // Determine the type of toggle (latest_product, top_rated_product, review_product)
            let isChecked = $(this).is(':checked');

            $.ajax({
                url: "{{ route('toggle.product') }}", // Unified route for all toggles
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: itemId,
                    toggle_type: toggleType,
                    value: isChecked ? 1 : 0
                },
                success: function(response) {
                    console.log(response.message); // Show success message
                },
                error: function(xhr) {
                    console.error('Error updating product:', xhr);
                }
            });
        });
    });
</script>
@endsection
