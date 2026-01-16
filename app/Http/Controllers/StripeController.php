<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function checkoutStripe(Request $request)
    {
        // storing information in metadata
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51MxLRRF1l0oQf2qDEmC5OTkyLCjlQpJtmSStZQCYyxWoN0fz2Q1JXLthaFvmfsoUEc8pBPLGyGgcfS8c7TsiJWQu00b1Y46CT4');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => 999 * 100,
            'currency' => 'myr',
            'description' => 'Example charge',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        // dd($charge);

        $total_amount = round(Cart::total());

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phone' => $request->phone,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'address2' => $request->address2,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,

            'paymentMethod' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,
            'invoice_number' => 'ZF'.mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('dMY'),
            'order_month' => Carbon::now()->format('M'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),

        ]);

        // sending email to Mailtrap

        // pass data
        $invoice = Order::findOrFail($order_id);

        $data = [
            'invoice_number' => $invoice->invoice_number,
            'amount' => $total_amount,
            'firstName' => $invoice->firstName,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'address' => $invoice->address,
            'zip' => $invoice->zip,

        ];

        Mail::to($request->email)->send(new OrderMail($data));

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor_id,
                'color' => $cart->options->color,
                'quantity' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        // empty the cart after checkout
        Cart::destroy();

        session()->flash('success', 'Your order had been placed.');

        return redirect('/category/details/all');

    }

    public function checkoutCash(Request $request)
    {

        $total_amount = round(Cart::total());

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phone' => $request->phone,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'address2' => $request->address2,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,

            'paymentMethod' => 'Cash on Delivery',
            // 'transaction_id' =>$charge->balance_transaction,
            'currency' => 'myr',
            'amount' => $total_amount,
            // 'order_number' =>$charge->metadata->order_id,
            'invoice_number' => 'ZF'.mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('dMY'),
            'order_month' => Carbon::now()->format('M'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),

        ]);

        // sending email to Mailtrap

        // pass data
        $invoice = Order::findOrFail($order_id);

        $data = [
            'invoice_number' => $invoice->invoice_number,
            'amount' => $total_amount,
            'firstName' => $invoice->firstName,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'address' => $invoice->address,
            'zip' => $invoice->zip,

        ];

        Mail::to($request->email)->send(new OrderMail($data));

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor_id,
                'color' => $cart->options->color,
                'quantity' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        // empty the cart after checkout
        Cart::destroy();

        session()->flash('success', 'Your order had been placed.');

        return redirect('/category/details/all');

    }
}
