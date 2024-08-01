<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    //
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken
            ]);
        } else {
            return response()->json(['error' => 'Credentials do not Match']);
        }
    }

    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ];
        User::create($data);
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ]);
    }

    public function user(Request $request)
    {
        $authUser = User::where('id', $request->id)->first();
        return response()->json([
            'authUser' => $authUser,
        ]);
    }
}
