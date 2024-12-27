<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_product_detail;
use PDF;

class PdfgenerateController extends Controller
{
    public function generate_PDF($id)
    {
        $invoice = Order::find($id);
        $order_list = Order_product_detail::where('order_id', $id)->first();
        
        if (!$invoice) {
            return redirect()->back()->withErrors('Invoice not found.');
        }

        $data = [
            'invoice' => $invoice,
            'order_list' => $order_list
        ];
      
        $pdf = PDF::loadView('admin.order.order-pdf', $data);
        return $pdf->download('invoice_' . $id . '.pdf');
    }
}
