<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function getPosts(?string $keywords, string $status) {

        if($status == 'my') {
            $posts = Post::title($keywords)
                ->text($keywords)
                ->simplePaginate(config('app.paginate'));
        } else if ($status == 'search') {
            $posts = Post::withoutGlobalScopes()
                ->title($keywords)
                ->text($keywords)
                ->simplePaginate(config('app.paginate'));
        }

        foreach($posts as $post) {
            $post['author'] = $post->user;
            $post['keywords'] = $post->tags;
        }

        return $posts;
    }

    public function createPost(array $data, ?string $keywords) {

        if(!empty($data['cover'])) {
            $cover = $data['cover'];
            $path = $cover->store('covers');
            $data['cover'] = $path;
        }

        $post = Post::create($data);
        $post->tags()->create(['name' => $keywords]);

    }

    public function updatePost(Post $post, array $data, ?string $keywords) {

        [
            'title' => $title,
            'text' => $text,
        ] = $data;

        $post->title = $title;
        $post->text = $text;

        if(!empty($data['cover'])) {
            $cover = $data['cover'];
            $path = $cover->store('covers');
            $post->cover = $path;
        } else {
            $post->cover = null;
        }

        $post->tags()->update(['name' => $keywords]);

        $post->save();
    }

    public function deletePost(Post $post) {
        $post->tags()->delete();
        $post->delete();
    }

}
