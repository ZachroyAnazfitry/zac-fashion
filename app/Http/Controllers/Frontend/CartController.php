<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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

        // for price
        if ($products->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->products_name,
                // 'qty' => $request->quantity,
                // 'price' => $request->price,
                'price' => '9.99',
                'qty' => '2',
                'weight' => 1,
                'options' => [
                    'size' => $request->size,
                    'color' => $request->color,
                ]
            ]);

            return response()->json(['success' => 'Products successfully added.']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->products_name,
                // 'qty' => $request->quantity,
                // 'price' => $request->discount_price,
                'weight' => 1,
                'price' => '9.99',
                'qty' => '2',
                'options' => [
                    'size' => $request->size,
                    'color' => $request->color,
                ]
            ]);

            return response()->json(['success' => 'Products successfully added into your cart.']);
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
            'cartQuantity' => $cartQuantity,
            'cartTotal' => $cartTotal,
        ));
    }
}
