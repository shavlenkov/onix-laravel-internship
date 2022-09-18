<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'full_name',
        'email',
        'password',
        'total_posts'
    ];

    public function posts() {
        return $this->hasMany(Post::class, 'userId');
    }

    public function scopeDateInterval($query, $startDate, $endDate) {
        return $query->withCount('posts')->where('created_at', '>', $startDate)
            ->where('created_at', '<', $endDate)->get();
    }

    public function scopeSearchByEmail($query, $keywords) {
        return $query->withCount('posts')->where('email', 'regexp', "^{$keywords}+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$")->get();
    }

    public function scopeSort($query, $param) {
        if($param == 'top') {
            return $this->withCount('posts')->orderBy('posts_count', 'DESC')->get();
        }
    }

    public function scopeAuthors($query) {
        return $query->withCount('posts')->having('posts_count', '>=', 1)->get();
    }

    protected static function boot()
    {
        parent::boot();
        User::saving(function ($model) {
            $model->full_name = $model->first_name." ".$model->last_name;
        });
    }

}
