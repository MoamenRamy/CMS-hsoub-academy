<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->post::with('user:id,name,profile_photo_path')->approved()->paginate(10);
        $title = 'جميع المنشورات';
        return view('index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $file->storeAs('public/image/', $filename);
        }

        $request->user()->posts()->create($request->all() + ['image_path'=>$filename ?? 'default.jpg']);
        return back()->with('success', 'تم اضافه المنشور بنجاح سيظهر بعد ان يوافق عليه المسؤول');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = $this->post::where('slug', $slug)->first();
        $comments = $post->comments->sortByDesc('created_at');

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $posts = $this->post->where('body', 'like', '%'.$request->keyword.'%')->with('user')->approved()->paginate(10);
        $title = 'نتائج البحث عن : '. $request->keyword;
        return view('/index', compact('posts', 'title'));
    }

    public function getByCategory($id)
    {
        $posts = $this->post::with('user')->whereCategory_id($id)->approved()->paginate(10);
        $title = 'المنشورات العائدة للتصنيف : '. Category::find($id)->title;

        return view('index', compact('posts', 'title'));
    }
}
