<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inbox;
use App\Models\Like;
use App\Models\OrderList;
use App\Models\OrderToAdmin;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    //

    public function history(Request $request)
    {
        $history = OrderList::where('user_id', $request->id)
            ->count();
        return response()->json([
            'history' => $history
        ]);
    }

    public function getHistory(Request $request)
    {
        $item = OrderList::where('user_id', $request->id)->get();
        return response()->json([
            'item' => $item
        ]);
    }

    public function getLike(Request $request)
    {
        $count = Like::where('post_id', $request->postId)
            ->count();
        $likeUser = Like::where('post_id', $request->postId)
            ->where('user_id', $request->userId)
            ->first();
        return response()->json([
            'count' => $count,
            'likeUser' => $likeUser
        ]);
    }

    public function like(Request $request)
    {

        Like::create([
            'user_id' => $request->userId,
            'post_id' => $request->postId,
            'like' => '1'
        ]);
        return $this->getLike($request);
    }

    public function unlike(Request $request)
    {

        Like::where('user_id', $request->userId)
            ->where('post_id', $request->postId)->delete();
        return $this->getLike($request);
    }

    public function list()
    {
        $order = OrderList::when(request('search'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('search') . '%')
                ->orwhere('order_code', 'like', '%' . request('search') . '%')
                ->orwhere('status', 'like', '%' . request('search') . '%');
        })
            ->select('order_lists.*', 'users.name')
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->paginate(20);
        return view('admin.order.order', compact('order'));
    }

    public function status(Request $request)
    {
        OrderList::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return response()->json();
    }

    public function detail($code)
    {
        $detail = OrderList::select('order_lists.*', 'users.name')
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->where('order_code', $code)->first();
        $order = OrderToAdmin::select('order_to_admins.*', 'posts.image', 'posts.title')
            ->leftJoin('posts', 'posts.id', 'order_to_admins.product_id')
            ->where('order_code', $code)
            ->get();
        return view('admin.order.detail', compact('detail', 'order'));
    }
}
