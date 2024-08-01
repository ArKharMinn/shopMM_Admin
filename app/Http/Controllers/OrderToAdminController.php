<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderList;
use App\Models\OrderToAdmin;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class OrderToAdminController extends Controller
{
    //
    public function orderToAdmin(Request $request)
    {
        $total = $request->total;
        $orderCode = rand(100000, 999999);

        foreach ($request->post as $item) {
            OrderToAdmin::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['qty'] * $item['price'],
                'order_code' => $orderCode
            ]);
        }
        Cart::where('user_id', $request->userId)->delete();
        $data = [
            'user_id' => $request->userId,
            'total' => $total,
            'order_code' => $orderCode
        ];
        OrderList::create($data);
        return response()->json();
    }

    public function viewCount(Request $request)
    {
        $count = Post::where('id', $request->id)->first();
        Post::where('id', $request->id)->update([
            'view_count' => $count->view_count + 1
        ]);
        return response()->json();
    }

    public function chatUserList()
    {
        $user = User::where('role', 'admin')->get();
        return response()->json([
            'user' => $user
        ]);
    }

    public function searchUserName(Request $request)
    {
        $user = User::where('name', 'like', '%' . $request->name . '%')
            ->where('role', 'admin')->get();
        return response()->json([
            'user' => $user
        ]);
    }
}
