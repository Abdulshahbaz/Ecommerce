<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-info div {
            width: 30%;
        }

        .invoice-info strong {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th {
            background: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .summary {
            text-align: right;
        }

        .summary th {
            text-align: left;
        }

        .summary td {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        .no-data {
            text-align: center;
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice</h1>

        <div class="invoice-info">
            <div>
                <strong>From:</strong>
                <p>
                    {{ $invoice->user->name }}<br>
                    {{ $invoice->address }}<br>
                    Phone: {{ $invoice->phone }}<br>
                    Email: {{ $invoice->email }}
                </p>
            </div>
            <div>
                <strong>To:</strong>
                <p>
                    {{ $invoice->user->name }}<br>
                    {{ $invoice->address }}<br>
                    Phone: {{ $invoice->phone }}<br>
                    Email: {{ $invoice->email }}
                </p>
            </div>
            <div>
                <b>Invoice #:</b> {{ $invoice->id }}<br>
                <b>Payment Status:</b> {{ $invoice->payment_status }}<br>
                <b>Transaction ID:</b> {{ $invoice->transaction_id }}<br>
                <b>Date:</b> {{ $invoice->created_at->format('d-m-Y') }}
            </div>
        </div>

        <h3>Order Details</h3>
        <table>
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

        <h3>Summary</h3>
        <table class="summary">
            <tr>
                <th>Subtotal:</th>
                <td>{{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            <tr>
                <th>Discount:</th>
                <td>{{ number_format($invoice->coupan_amount, 2) }}</td>
            </tr>
            <tr>
                <th>Total:</th>
                <td>{{ number_format($invoice->total, 2) }}</td>
            </tr>
        </table>

        <div class="footer">
            Thank you for your business! If you have any questions about this invoice, please contact us.
        </div>
    </div>
</body>
</html>
