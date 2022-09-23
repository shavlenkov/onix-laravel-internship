<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Scopes\MyPostsScope;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'text',
        'userId'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MyPostsScope);
    }

    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'post_tags', 'postId', 'tagId');
    }

    public function scopeTitle($query, $title) {
        return $query->orWhere('title', 'like', "%{$title}%");
    }

    public function scopeText($query, $text) {
        return $query->orWhere('text', 'like', "%{$text}%");
    }

}
