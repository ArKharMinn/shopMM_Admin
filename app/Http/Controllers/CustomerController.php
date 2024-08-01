<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function list()
    {
        $customer = User::where('role', 'customer')
            ->when(request('search'), function ($query) {
                $query->orWhere('name', 'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%')
                    ->orWhere('phone', 'like', '%' . request('search') . '%');
            })
            ->paginate(10);
        $customer->appends(request()->all());
        return view('admin.customer.list', compact('customer'));
    }

    public function delete(Request $request)
    {
        User::where('id', $request->id)->delete();
        return response()->json();
    }
}
