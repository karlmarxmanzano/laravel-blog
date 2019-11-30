<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with(['user', 'comments'])->paginate(10);
        
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        if($request->hasFile('post_img'))
        {
            $img_name = rand() . '.' . $request->file('post_img')->getClientOriginalExtension();
            $request->file('post_img')->move('storage/images', $img_name);
        }

        $user = User::find(auth()->id());
        $user->posts()->create([
            'title' => $request->post_title,
            'body' => $request->post_body,
            'img' => $img_name
        ]);

        return redirect()->route('post.index')->with('status', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, Post $post)
    {
        $this->authorize('update', $post);

        if($request->hasFile('post_img'))
        {
            $img_name = rand() . '.' . $request->file('post_img')->getClientOriginalExtension();
            $request->file('post_img')->move('storage/images', $img_name);

            $post->update([
                'img' => $img_name
            ]);
        }
        
        $post->update([
            'title' => $request->post_title,
            'body' => $request->post_body
        ]);

        return redirect()->back()->with('status', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->back();
    }
}
