<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePostRequest;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {

        $posts = Post::simplePaginate(config('app.paginate'));

        $keywords = $request->query('keywords');

        if(!empty($keywords)) {
            $posts = Post::where('title', 'like', "%{$keywords}%")
                ->orWhere('text', 'like', "%{$keywords}%")->get();
        }

        return $posts;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePostRequest $request)
    {
        $post = Post::create($request->all());

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
        return $post;
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
        $post->title = $request->input('title');
        $post->keywords = $request->input('keywords');
        $post->text = $request->input('text');

        $post->save();

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
        $post->delete();

        return response()
            ->json(['success' => true]);
    }

}
