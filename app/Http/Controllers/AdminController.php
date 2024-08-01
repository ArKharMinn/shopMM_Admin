<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exam;
use App\Models\Post;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        $admin = User::where('role', 'admin')->get();
        $customer = User::where('role', 'customer')->get();
        $categroy = Category::get();
        $product = Post::get();
        return view('admin.home.dashboard', compact('admin', 'customer', 'categroy', 'product'));
    }

    public function chart()
    {
        $users = User::select('id', 'created_at')
            ->where('role', 'customer')->get();

        $userCounts = $users->groupBy(function ($date) {
            return $date->created_at->format('Y-m-d');
        })->map(function ($group) {
            return $group->count();
        });

        return response()->json($userCounts);
    }

    public function list()
    {
        $admin = User::when(request('search'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orWhere('address', 'like', '%' . request('search') . '%');
        })
            ->where('role', 'admin')
            ->paginate(10);
        $admin->appends(request()->all());
        return view('admin.adminList.list', compact('admin'));
    }

    public function delete(Request $request)
    {
        User::where('id', $request->id)->delete();
        return response()->json();
    }

    public function manage()
    {
        $admin = User::where('id', Auth::user()->id)->first();
        return view('admin.setting.list', compact('admin'));
    }

    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
        User::where('id', Auth::user()->id)->update($data);
        return back()->with([
            'profile' => 'changed'
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->select('password')->first();
        $dbPass = $user->password;
        if (Hash::check($request->oldPassword, $dbPass)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', $userId)->update($data);
            return back()->with(['success' => 'passchange']);
        };
        return back()->with(['notMatch' => 'failed']);
    }
}
