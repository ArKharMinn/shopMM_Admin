<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function list()
    {
        $data = Category::when(request('search'), function ($query) {
            $query->orWhere('title', 'like', '%' . request('search') . '%');
        })
            ->paginate(10);
        $data->appends(request()->all());
        return view('admin.category.list', compact('data'));
    }

    public function create(Request $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        Category::create($data);
        return back()->with([
            'create' => 'success'
        ]);
    }

    public function delete(Request $request)
    {
        Category::where('id', $request->id)->delete();
        return response()->json();
    }

    public function editView(Request $request)
    {
        $detail = Category::where('id', $request->id)->get();
        return response()->json($detail);
    }

    public function edit(Request $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];
        Category::where('id', $request->id)->update($data);
        return back();
    }
}
