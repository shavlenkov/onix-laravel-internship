<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Post;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePostRequest;

use App\Http\Resources\PostResource;

use Auth;

use App\Services\PostService;

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
     * Display a listing of the resource
     *
     * @param Request $request
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {

        $keywords = $request->query('keywords');

        $posts = $this->postService->getPosts($keywords, 'my');

        return PostResource::collection($posts);
    }

    public function search(Request $request)
    {

        $keywords = $request->query('keywords');

        $posts = $this->postService->getPosts($keywords, 'search');

        return PostResource::collection($posts);
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

        return response()
            ->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post['author'] = $post->user;
        $post['keywords'] = $post->tags;

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        $this->postService->updatePost($post, $data, $request->input('keywords'));

        return response()
            ->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);

        return response()
            ->json(['success' => true]);
    }

}
