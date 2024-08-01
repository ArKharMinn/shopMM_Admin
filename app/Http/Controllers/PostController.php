<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function list()
    {
        $product = Post::when(request('search'), function ($query) {
            $query->orWhere('title', 'like', '%' . request('search') . '%');
        })
            ->select('posts.*', 'categories.title as category')
            ->leftJoin('categories', 'categories.id', 'posts.category_id')
            ->paginate(10);
        $category = Category::get();
        $product->appends(request()->all());
        return view('admin.product.list', compact('product', 'category'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
        ]);
        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileName);
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $fileName
        ]);
        return redirect()->route('product#list')->with([
            'create' => 'success'
        ]);
    }

    public function detail(Request $request)
    {
        $detail = Post::where('id', $request->id)->get();
        return response()->json($detail);
    }

    public function delete(Request $request)
    {
        Post::where('id', $request->id)->delete();
        return response()->json();
    }

    public function edit(Request $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category,
            'discount' => $request->discount,
        ];
        Post::where('id', $request->id)->update($data);
        return back()->with([
            'edit' => 'success'
        ]);
    }
}
