<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Order_detail;
use App\Models\Product;
use DB;

class OrderController extends Controller
{
public function index()
{
    $orders = Order::all();
    return view('admin.order.order', compact('orders'));
}


    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.order', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->Status = $request->input('Status');
        $order->save();

        return redirect()->route('admin.order.order')->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    public function show($id)
    {
        // Tải mối quan hệ customer và orderDetails
        $order = Order::with(['orderDetails.product'])->findOrFail($id);
        
        return view('admin.order.show', compact('order'));
    }
    
}