<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class  StatusController extends Controller
{
    public function update_payment_Status(Request $request, $id)
    {

        $payment_status = Order::findOrFail($id);
        $payment_status->payment_status = $request->newPaymentStatus;
        $payment_status->save();

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

    public function update_order_Status(Request $request, $id)
    {
       $order_status = Order::findOrFail($id);
       $order_status->order_status = $request->neworderStatus;
       $order_status->save();
       return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
