<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        $productId = $product->id;

        $product = Product::find($productId);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Product added to cart'
        ]);
    }

    public function updateCart(Request $request, Product $product)
    {
        $productId = $product->id;

        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Cart updated successfully'
        ]);
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return response()->json([
                'message' => 'cart is empty'
            ]);
        }

        $user = $request->user();

        $order = Order::create([
            'user_id' => $user->id
        ]);

        foreach ($cart as $productId => $value) {
            $product = Product::find($productId);

            if ($product->stock >= $value['quantity']) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $value['quantity'],
                    'price' => $value['price'],
                ]);

                $product->stock -= $value['quantity'];
                $product->save();
            } else {
                return response()->json([
                    'message' => 'Stock insufficient!'
                ]);
            }
        }

        session()->forget('cart');

        return response()->json([
            'message' => 'Order placed successfully'
        ]);
    }
}
