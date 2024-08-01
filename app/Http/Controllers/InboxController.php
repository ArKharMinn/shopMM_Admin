<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    public function list()
    {
        $cus = User::when(request('search'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('search') . '%');
        })
            ->where('role', 'customer')->get();
        $message = Inbox::orWhere('from_userId', request('id'))
            ->orWhere('to_userId', request('id'))
            ->get();
        $cusDetail = User::where('id', request('id'))->first();
        return view('admin.chat.list', compact('cus', 'message', 'cusDetail'));
    }

    public function send(Request $request)
    {
        if ($request->message !== '' && $request->message !== null) {
            Inbox::create([
                'to_userId' => $request->cusId,
                'from_userId' => Auth::user()->id,
                'message' => $request->message,
            ]);
            return back();
        } else {
            return back();
        }
    }
}
