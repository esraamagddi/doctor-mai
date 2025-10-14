<?php

namespace Solutions\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Solutions\Blog\Models\Post;
use Solutions\Blog\Models\Category;

class PostController extends Controller
{
    /** جلب اللغات المفعلة + تحديد التاب النشط */
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)->orderBy('order')->get(['name','code']);
        } catch (\Throwable $e) {
            $langs = collect([
                (object)['name' => 'English', 'code' => 'en'],
                (object)['name' => 'العربية', 'code' => 'ar'],
            ]);
        }

        $activeLocale = $request->get('lang', $langs->first()->code ?? 'en');
        return [$langs, $activeLocale];
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $items = Post::orderBy('order')->orderByDesc('id')->paginate($perPage);
        $categories = Category::orderBy('order')->get();
        return view('blog::posts.index', compact('items','categories'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $post = new Post();
        $categories = Category::orderBy('order')->get();
        $currentEdition = null; 
        return view('blog::posts.create', compact('post','langs','activeLocale','categories'));
    }

public function store(Request $request)
{
    [$langs, $activeLocale] = $this->resolveLocales($request);

    $data = $request->validate([
        'title' => 'required|array',
        'content' => 'nullable|array',
        'description' => 'nullable|array',
        'author' => 'nullable|array',
        'image' => 'nullable|image|max:2048',
        'category_id' => 'nullable|exists:categories,id',
        'order' => 'nullable|integer|min:0',
        'status' => 'nullable|boolean',
        'published_at' => 'nullable|date',
    ]);

    // أرفع حالة النشر والـ order
    $data['status'] = (bool) ($data['status'] ?? 1);
    $data['order'] = $data['order'] ?? ((int) Post::max('order') + 1);


    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('posts','public');
    }

    $post = Post::create($data);

    return redirect()->route('blog.posts.index')->with('success', 'Created');
}


    public function edit(Request $request, Post $post)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $categories = Category::orderBy('order')->get();


        return view('blog::posts.edit', compact('post','langs','activeLocale','categories'));
    }

public function update(Request $request, Post $post)
{
    [$langs, $activeLocale] = $this->resolveLocales($request);

    $data = $request->validate([
        'title' => 'required|array',
        'content' => 'nullable|array',
        'description' => 'nullable|array',
        'author' => 'nullable|array',
        'image' => 'nullable|image|max:2048',
        'category_id' => 'nullable|exists:categories,id',
        'order' => 'nullable|integer|min:0',
        'status' => 'nullable|boolean',
        'published_at' => 'nullable|date',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('posts','public');
    } else {
        unset($data['image']);
    }

    $data['status'] = $data['status'] ?? $post->status;

   

    $post->update($data);


    return redirect()->route('blog.posts.index')->with('success', 'Updated');
}

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Deleted');
    }

    public function toggleStatus(Post $post)
    {
        $post->status = !$post->status;
        $post->save();
        return back()->with('success', 'Toggled');
    }

public function updateOrder(Request $request)
{
    $payload = $request->input('rows', $request->input('orders', $request->input('order', [])));

    if (!is_array($payload) || empty($payload)) {
        return response()->json(['ok' => false, 'message' => 'No payload'], 422);
    }

    $isList = array_keys($payload) === range(0, count($payload) - 1);

    $rows = [];
    if ($isList) {
        foreach ($payload as $row) {
            if (!isset($row['id'])) continue;
            $rows[(int)$row['id']] = (int)($row['order'] ?? 0);
        }
    } else {
        foreach ($payload as $id => $order) {
            $rows[(int)$id] = (int)$order;
        }
    }

    if (!$rows) {
        return response()->json(['ok' => false, 'message' => 'No valid rows'], 422);
    }

    foreach ($rows as $id => $ord) {
        Post::whereKey($id)->update(['order' => $ord]);
    }

    return response()->json(['ok' => true]);
}

}
