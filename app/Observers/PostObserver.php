<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{

    public function creating(Post $post)
    {
        $post->user()->increment('total_posts');
    }

    public function deleted(Post $post)
    {
        $post->user()->decrement('total_posts');
    }

}
