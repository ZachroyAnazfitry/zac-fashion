<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $products = Products::find($id);
        // Cart::add([
        //     'id' => $id,
        //     'name' => $request->products_name,
        //     'qty' => '2',
        //     'price' => '9.99',
        //     'weight' => 1,
        //     'options' => [
        //         'size' => $request->size,
        //         'color' => $request->color,
        //     ]
        // ]);

        // return response()->json(['success' => 'Products successfully added on your cart.']);

        // if (!$products) {
        //     return response()->json(['error' => 'Invalid product ID.']);
        // }

        // for using GET method
        // return response()->json(array(
        //     'products' => $products,
        // ));


        // try {
        //     $products = Products::findOrFail($id);
        // } catch (ModelNotFoundException $e) {
        //     return response()->json(['error' => 'Product not found.'], 404);
        // }

        if (Auth::check()) {
            // for price
            if ($products->discount_price == NULL) {
                Cart::add([
                    'id' => $id,
                    'name' => $request->products_name,
                    // 'qty' => $request->quantity,
                    'price' => $products->price,
                    'qty' => '1',
                    'weight' => 1,
                    'options' => [
                        // 'size' => $request->size,
                        'picture' => $products->picture,
                        'color' => $request->color,
                        'vendor_id' => $request->vendor_id,
                    ]
                ]);

                return response()->json(['success' => 'Products successfully added.']);
            } else {
                Cart::add([
                    'id' => $id,
                    'name' => $request->products_name,
                    'price' => $products->discount_price,
                    'weight' => 1,
                    // 'qty' => $request->quantity,
                    'qty' => '1',
                    // 'size' => $request->size,
                    'options' => [
                        // 'size' => $request->size,
                        'picture' => $products->picture,
                        'color' => $request->input('color'),
                        'vendor_id' => $request->vendor_id,
                    ]
                ]);

                return response()->json(['success' => 'Products successfully added into your cart.']);
            }
        } else {
            return response()->json(['error' => 'Please login first before shopping.']);
        }
                 
    }

    public function miniCart()
    {
        // get data
        $carts = Cart::content();
        $cartQuantity = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQuantity' => $cartQuantity, //for displaying cartCount
            'cartTotal' => $cartTotal,  // for displaying total price
        ));
    }

    public function cartRemove($rowId)
    {
        // call method to remove
        Cart::remove($rowId);
        return response()->json(['success' => 'Products successfully removed from your cart.']);

    }

    public function myCart()
    {
        return view('homepage.mycart');
    }

    public function getCart()
    {
         // get data
         $carts = Cart::content();
         $cartQuantity = Cart::count();
         $cartTotal = Cart::total();
 
         return response()->json(array(
             'carts' => $carts,
             'cartQuantity' => $cartQuantity, //for displaying cartCount
             'cartTotal' => $cartTotal,  // for displaying total price
         ));
    }

    public function removeCart($rowId)
    {

        Cart::remove($rowId);
        // pass the variables
        return response()->json(['success' => 'Product successfully removed from your cart.']);
    }

    public function checkoutProducts()
    {

        if (Auth::check()) {

            // condition to check atleast 1 product exist
            if (Cart::total() > 0) {
                // get data
                $carts = Cart::content();
                $cartQuantity = Cart::count();
                $cartTotal = Cart::total();

                return view('homepage.checkout', compact('carts', 'cartQuantity', 'cartTotal'));
            } else {

                session()->flash('error', 'Need at least one product to checkout.');
                return back();

            }
            
        } else {
            session()->flash('message', 'Please login to proceed.');
        }
        
        return redirect()->route('login');
    }

    public function checkoutStore(Request $request)
    {
       $checkout = array();
       $checkout['firstName'] = $request->firstName;
       $checkout['lastName'] = $request->lastName;
       $checkout['phone'] = $request->phone;
       $checkout['username'] = $request->username;
       $checkout['email'] = $request->email;
       $checkout['address'] = $request->address;
       $checkout['address2'] = $request->address2;
       $checkout['country'] = $request->country;
       $checkout['state'] = $request->state;
       $checkout['zip'] = $request->zip;
       $checkout['country'] = $request->country;
       $checkout['paymentMethod'] = $request->paymentMethod;
       $cartTotal = Cart::total();

    //    condition for payment method
    if ($request->paymentMethod == 'stripe') {
        return view('homepage.stripePayment', compact('checkout','cartTotal'));
    } elseif($request->paymentMethod == 'credit'){
        return view('homepage.creditPayment', compact('checkout','cartTotal'));
    }
    else {
        return view('homepage.cashPayment', compact('checkout','cartTotal'));
    }

    

    }
}
