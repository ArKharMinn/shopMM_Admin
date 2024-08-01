<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function category()
    {
        $category = Category::orderBy('title', 'asc')->get();
        return response()->json([
            'category' => $category
        ]);
    }

    public function post()
    {
        $post = Post::orderBy('created_at', 'desc')
            ->paginate(20);
        return response()->json([
            'post' => $post
        ]);
    }

    public function categorySearch(Request $request)
    {
        $search = Post::where('category_id', 'like', '%' . $request->id . '%')->get();
        return response()->json([
            'search' => $search
        ]);
    }

    public function postSearch(Request $request)
    {
        $search = Post::where('title', 'like', '%' . $request->title . '%')->get();
        return response()->json([
            'search' => $search
        ]);
    }

    public function postDetail(Request $request)
    {
        $detail = Post::where('id', $request->id)->get();
        return response()->json([
            'detail' => $detail
        ]);
    }

    public function relatedPost(Request $request)
    {
        $relatedPost = Post::where('category_id', $request->categoryId)->get();
        return response()->json([
            'relatedPost' => $relatedPost
        ]);
    }
}
