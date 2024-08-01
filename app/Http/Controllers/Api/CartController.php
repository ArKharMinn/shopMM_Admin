<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addCart(Request $request)
    {
        $data = [
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'user_id' => $request->user_id
        ];
        Cart::create($data);
        return response()->json([
            'success' => 'Successfully Added to Cart'
        ]);
    }

    public function cart(Request $request)
    {
        $cart = Cart::where('user_id', $request->id)
            ->count();
        return response()->json([
            'cart' => $cart
        ]);
    }

    public function cartList(Request $request)
    {
        $cart = Cart::select('carts.*', 'posts.title', 'posts.price')
            ->leftJoin('posts', 'posts.id', 'carts.product_id')
            ->where('user_id', $request->id)
            ->get();
        return response()->json([
            'cart' => $cart
        ]);
    }

    public function cartRemove(Request $request)
    {
        Cart::where('id', $request->id)->delete();
        $cart = Cart::select('carts.*', 'posts.title', 'posts.price')
            ->leftJoin('posts', 'posts.id', 'carts.product_id')
            ->where('user_id', $request->userId)
            ->get();
        return response()->json([
            'cart' => $cart
        ]);
    }

    public function updateLocation(Request $request)
    {
        User::where('id', $request->id)->update([
            'address' => $request->address
        ]);
        $user = User::where('id', $request->id)->first();
        return response()->json([
            'user' => $user
        ]);
    }
}
