<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Inbox;
use Illuminate\Http\Request;

class ChatBoxController extends Controller
{
    //
    public function list()
    {
        return view('admin.chat.list');
    }


    public function getMessage(Request $request)
    {
        $message = Inbox::orWhere('to_userId', $request->id)
            ->orWhere('from_userId', $request->id)
            ->orWhere('to_userId', $request->from_userId)
            ->orWhere('from_userId', $request->from_userId)->get();
        return response()->json([
            'message' => $message
        ]);
    }

    public function sendMessage(Request $request)
    {
        Inbox::create([
            'message' => $request->message,
            'to_userId' => $request->to_userId,
            'from_userId' => $request->from_userId,
        ]);
        $message = Inbox::orWhere('to_userId', $request->id)
            ->orWhere('from_userId', $request->id)
            ->orWhere('to_userId', $request->from_userId)
            ->orWhere('from_userId', $request->from_userId)->get();
        return response()->json([
            'message' => $message
        ]);
    }

    public function getComment(Request $request)
    {
        $comments = Comment::select('comments.*', 'users.name')
            ->leftJoin('users', 'users.id', 'comments.user_id')
            ->where('post_id', $request->postId)
            ->get();
        return response()->json([
            'comments' => $comments
        ]);
    }

    public function postComment(Request $request)
    {
        Comment::create([
            'user_id' => $request->userId,
            'post_id' => $request->postId,
            'comment' => $request->comment,
        ]);
        $comments = Comment::select('comments.*', 'users.name')
            ->leftJoin('users', 'users.id', 'comments.user_id')
            ->where('post_id', $request->postId)
            ->get();
        return response()->json([
            'comments' => $comments
        ]);
    }
}
