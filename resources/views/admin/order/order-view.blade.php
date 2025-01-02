@extends('admin.layout.app')
@section('content')
@section('page_title','Order-View')
{{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(session('success'))
    <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 10px; right: 10px; z-index: 1050;">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <small class="float-right">Date:{{ $invoice->created_at->format('d-m-Y') }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{$invoice->user->name}}</strong><br>
                    {{$invoice->address}}<br>
                    Phone: {{$invoice->phone}}<br>
                    Email: {{$invoice->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$invoice->user->name}}</strong><br>
                    {{$invoice->address}}<br>
                    Phone: {{$invoice->phone}}<br>
                    Email: {{$invoice->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #007612</b><br>
                  <br>
                  <b>Order ID: </b>{{$invoice->id}}<br>
                  <b>Order Status: </b>{{$invoice->order_status}}<br>
                  <b>Payemnt Status: </b> {{ $invoice->payment_status }}<br>
                  <b>transaction_id: </b>{{$invoice->transaction_id}}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Mobile</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        @if ($order_list)    
                        <td>{{$order_list->qty}}</td>
                        <td>{{$order_list->product->name}}</td>
                        <td>{{$invoice->phone}}</td>
                        <td>{{$invoice->or_no}}</td>
                        <td>{{number_format($order_list->amount,2)}}</td>
                        
                        @else
                            <td colspan="2">Order details not found</td>
                        @endif
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="{{asset('admin/dist/img/credit/visa.png')}}" alt="Visa">
                  <img src="{{asset('admin/dist/img/credit/mastercard.png')}}" alt="Mastercard">
                  <img src="{{asset('admin/dist/img/credit/american-express.png')}}" alt="American Express">
                  <img src="{{asset('admin/dist/img/credit/paypal2.png')}}" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"> Date : {{ $invoice->created_at->format('d-m-Y') }}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{ number_format($invoice->subtotal, 2) }}</td>
                      </tr>
                      <tr>
                        <th>Discount</th>
                        <td>{{number_format($invoice->coupan_amount,2) }}</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{ number_format($invoice->total, 2) }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#paymentStatusModal">
                    <i class="far fa-credit-card"></i> Payment Status
                </button>

                <button type="button" class="btn btn-warning float-right"  style="margin-right: 5px;" 
                     @if($invoice->order_status == 'Deliver' || $invoice->order_status == 'Cancel') disabled  @else   data-toggle="modal" data-target="#orderStatusModal" @endif>
                  <i class="far fa-credit-card"></i> Order Status
              </button>
                

                  <a href="{{ route('order.generatePDF', $invoice->id) }}" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal payment status Form -->
<div class="modal fade" id="paymentStatusModal" tabindex="-1" role="dialog" aria-labelledby="paymentStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="paymentStatusModalLabel">Update Payment Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="POST" action="{{ route('update.payment.status', $invoice->id) }}">
              @csrf
              <div class="modal-body">
                  <!-- Current Payment Status -->
                  <div class="form-group">
                      <label for="currentPaymentStatus">Current Payment Status</label>
                      <input type="text" class="form-control" id="currentPaymentStatus" name="currentPaymentStatus" value="{{ $invoice->payment_status }}" readonly>
                  </div>

                  <!-- Update Payment Status -->
                  <div class="form-group">
                      <label for="newPaymentStatus">New Payment Status</label>
                      <select class="form-control" id="newPaymentStatus" name="newPaymentStatus">
                          <option value="Pending" {{ $invoice->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                          <option value="Completed" {{ $invoice->payment_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                      </select>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
          </form>
      </div>
  </div>
</div>

      <!-- Modal order status Form -->
      <div class="modal fade" id="orderStatusModal" tabindex="-1" role="dialog" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderStatusModalLabel">Update Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('update.order.status', $invoice->id) }}">
                    @csrf
                    <div class="modal-body">
                        <!-- Current order Status -->
                        <div class="form-group">
                            <label for="currentorderStatus">Current Order Status</label>
                            <input type="text" class="form-control" id="currentorderStatus" name="currentorderStatus" value="{{ $invoice->order_status }}" readonly>
                        </div>
      
                        <!-- Update order Status -->
                        <div class="form-group">
                            <label for="neworderStatus">New Order Status</label>
                            <select class="form-control" id="neworderStatus" name="neworderStatus">
                                <option value="Pending" {{ $invoice->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="On_The_Way" {{ $invoice->order_status == 'On_The_Way' ? 'selected' : '' }}>On The Way</option>
                                <option value="Inprogress" {{ $invoice->order_status == 'Inprogress' ? 'selected' : '' }}>Inprogress</option>

                                <option value="Paking" {{ $invoice->order_status == 'Paking' ? 'selected' : '' }}>Paking</option>
                                <option value="Deliver" {{ $invoice->order_status == 'Deliver' ? 'selected' : '' }}>Deliver</option>
                                <option value="Cancel" {{ $invoice->order_status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
      </div>

    </section>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.querySelector('.toast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
</script>
@endsection
