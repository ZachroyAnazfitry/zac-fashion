<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrdersController extends Controller
{
    public function showOrders()
    {
        $orders = Order::all();
        return view('admin.orders.orders', compact('orders'));
    }

    public function showOrdersVendor()
    {
        $id = Auth::user()->id;
        $orderItems = OrderItem::with('order')->where('vendor_id', $id)->orderBy('id','desc')->get();
        return view('vendor.orders.orders', compact('orderItems'));
    }

    public function showOrdersDetails($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id','desc')->get();
        return view('admin.orders.ordersDetails', compact('order','orderItem'));
    }

    public function pendingToConfirm($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'Confirmed'
        ]);

        // noti
        session()->flash('message', 'Products confirmed succesfully!');

        return redirect()->route('orders');
    }

    public function confirmToProcessed($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'Processing'
        ]);

        // noti
        session()->flash('message', 'Products will be processed for delivery!');

        return redirect()->route('orders');
    }

    public function processToDelivered($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'Delivered'
        ]);

        // noti
        session()->flash('message', 'Products delivered succesfully!');

        return redirect()->route('orders');
    }

    public function orderInvoice($order_id)
    {

        $carts = Cart::content();
        $cartQuantity = Cart::count();
        $cartTotal = Cart::total();

        $order = Order::with('user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id','DESC')->get();;
    //    return view("homepage.orderDetails", compact('order','orderItem'));
        
        $pdf = Pdf::loadView('admin.orders.orderInvoice', compact('order','orderItem','carts','cartQuantity','cartTotal'))->setPaper('a4');
        return $pdf->download('Orders Invoice.pdf');
    }

    
}
