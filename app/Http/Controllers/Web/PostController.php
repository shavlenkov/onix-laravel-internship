<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreUpdatePostRequest;

use App\Models\Post;

use App\Services\PostService;

use Auth;

class PostController extends Controller
{

    protected $postService;

    /**
     * PostController constructor.
     */
    public function __construct() {
        $this->postService = new PostService();
    }

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

        $this->postService->createPost($data, $request->input('keywords'));

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
        $data = $request->validated();

        $this->postService->updatePost($post, $data, $request->input('keywords'));

        return redirect()
            ->route('posts.index');
    }

}
