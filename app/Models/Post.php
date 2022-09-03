<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'text',
        'userId'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'post_tags', 'postId', 'tagId');
    }
}
