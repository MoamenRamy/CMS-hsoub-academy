<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $comment = $this->comment;
        $comment->body = $request->get('body');
        $comment->user()->associate($request->user());
        $comment->post_id = $request->get('post_id');
        $post = Post::find($request->get('post_id'));

        $post->comments()->save($comment);

        return back()->with('success', 'تم اضافه التعليق بنجاح');
    }

    public function replyStore(Request $request)
    {
        $this->validate($request, [
            'comment_body' => 'required',
        ]);

        $reply = new Comment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $reply->post_id = $request->get('post_id');
        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back()->with('success', 'تم الرد علي التعليق بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
