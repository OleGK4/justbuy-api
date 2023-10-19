<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $orders = $user->orders;

            return response()->json(['data' => $orders], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * Store a newly created order in the database.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart;

        if (!$cart || $cart->cartProducts->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty'], 400);
        }

        // Calculate the total price of the order based on the products in the cart.
        $totalPrice = $cart->cartProducts->sum(function ($cartProduct) {
            return $cartProduct->product->price;
        });

        // Create a new order in the database.
        $order = Order::create([
            'user_id' => $user->id,
            'price' => $totalPrice,
        ]);

        // Move the cart products to the order.
        foreach ($cart->cartProducts as $cartProduct) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cartProduct->product_id,
            ]);
        }

        // Clear the user's cart.
        CartProduct::where('cart_id', $cart->id)->delete();

        // Timestamp updates
        $cartT = Cart::where('id', $cart->id)->first();
        if ($cartT) {
            $cartT->touch();
        }

        return response()->json(['message' => 'Order created successfully'], 201);
    }
}
