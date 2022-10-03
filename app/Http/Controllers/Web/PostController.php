<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreUpdatePostRequest;

use App\Models\Post;

use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::simplePaginate(config('app.paginate'));

        return view('posts.index')
            ->with('posts',  $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePostRequest $request)
    {

        $data = $request->validated();
        $data['userId'] = Auth::user()->id;

        if(!empty($data['cover'])) {
            $cover = $data['cover'];
            $path = $cover->store('covers');
            $data['cover'] = $path;
        } else {
            $data['cover'] = '';
        }

        $post = Post::create($data);
        $post->tags()->create(['name' => $request->input('keywords')]);

        return redirect()
            ->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePostRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->text = $request->input('text');

        if(!empty($request->file('cover'))) {
            $cover = $request->file('cover');

            $path = $cover->store('covers');
            $post->cover = $path;
        } else {
            $post->cover = "";
        }

        $post->tags()->update(['name' => $request->input('keywords')]);

        $post->save();

        return redirect()
            ->route('posts.index');
    }

}
