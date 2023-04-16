<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function showOrders()
    {
        $orders = Order::where('status', 'pending')->orderBy('id','desc')->get();
        return view('admin.orders.orders', compact('orders'));
    }
}
