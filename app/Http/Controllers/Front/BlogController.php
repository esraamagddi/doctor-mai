<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Solutions\Blog\Models\Post;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // جلب المقالات مرتبة حسب العمود order
        $blogs = Post::where('status', true)
            ->where('category_id', 1)
            ->orderBy('order')       // الترتيب المخزن
            ->orderByDesc('id')      // إذا تساوى order
            ->paginate(12);

        return view('front.blog.index', compact('blogs'));
    }

    public function blogDetails($id, Request $request)
    {
        $post = Post::findOrFail($id);

        // جلب المقالات المتعلقة بنفس الفئة وترتيبها حسب order
        $relatedPosts = Post::where('status', true)
            ->where('category_id', 1)
            ->where('id', '<>', $id)
            ->orderBy('order')
            ->orderByDesc('id')
            ->take(4)
            ->get();

        return view('front.blog.details', compact('post', 'relatedPosts'));
    }
}
