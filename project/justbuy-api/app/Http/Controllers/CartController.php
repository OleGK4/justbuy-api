<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $cart = $user->cart;

            if ($cart && $cart->cartProducts->isNotEmpty()) {
                return response()->json(['data' => $cart->cartProducts], 200);
            } else {
                return response()->json(['message' => 'Cart is empty'], 200);
            }
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $userCart = $request->user()->cart;

        $data = [
            'product_id' => $product->id,
            'cart_id' => $userCart->id,
        ];
        CartProduct::create($data);

        return response()->json([
            'message' => 'Product added to cart'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        $cartProduct = CartProduct::find($request->product_id);


        if (!$cartProduct) {
            return response()->json(['message' => 'Cart product not found'], 404);
        }

        if ($user->cannot('delete', $cartProduct)) {
            return response()->json(['message' => 'Forbidden for you!'], 403);
        }

        $cartProduct->delete();

        $cart = Cart::where('id', $user->cart->id)->first();
        if ($cart) {
            $cart->touch();
        }

        return response()->json(['message' => 'Product deleted from cart']);
    }
}
