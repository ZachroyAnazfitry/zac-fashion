<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //

    public function customerPage()
    {
        return view('landing-page')->with('message', "You're logged in. Let's shopping!!");
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('warning', 'You are logged out!');
    }

    public function customerRegister()
    {
        return view('homepage.customer-register');
    }

    public function customerProfile()
    {

        $id = Auth::user()->id;
        $customers = User::find($id);

        return view('homepage.customer-profile', compact('customers'));
    }

    public function customerEditProfile(Request $request)
    {
        $id = Auth::user()->id;
        $customers = User::find($id);

        // $request->validate([
        //     'first_name' =>'required|max:255',
        //     'last_name' =>'required|max:255',
        //     'email' =>'required|email|unique:customers,email',
        //     'password' =>'required|min:6|confirmed',
        // ]);

        $customers->username = $request->username;
        $customers->name = $request->name;
        $customers->address = $request->address;
        $customers->email = $request->email;
        $customers->phone = $request->phone;
        // $customers->password = bcrypt($request->password);

        $customers->save();

        session()->flash('info', 'Profile updated succesfully!');

        return back();
        // return back()->with('success', "Profile updated successfully!");
    }

    public function viewOrderDetails()
    {
        // trace user_id
        $order = Order::where('user_id', Auth::id())->first();

        return view('homepage.viewOrderDetails', compact('order'));
    }

    public function orderInvoice($order_id)
    {

        $carts = Cart::content();
        $cartQuantity = Cart::count();
        $cartTotal = Cart::total();

        $order = Order::with('user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        //    return view("homepage.orderDetails", compact('order','orderItem'));

        $pdf = Pdf::loadView('homepage.orderInvoice', compact('order', 'orderItem', 'carts', 'cartQuantity', 'cartTotal'))->setPaper('a4');

        return $pdf->download('Invoice.pdf');
    }
}
