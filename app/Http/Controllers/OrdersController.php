<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function showOrders()
    {
        $orders = Order::where('status', 'pending')->orderBy('id','desc')->get();
        return view('admin.orders.orders', compact('orders'));
    }

    public function showOrdersVendor()
    {
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id','desc')->get();
        return view('vendor.orders.orders', compact('orderItems'));
    }
}
