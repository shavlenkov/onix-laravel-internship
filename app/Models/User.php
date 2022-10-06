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

    public function scopeDateInterval($query, ?string $startDate, ?string $endDate) {

        if(empty($startDate) || empty($endDate)) {
            return $query;
        }

        return $query->withCount('posts')->having('created_at', '>', $startDate)
            ->having('created_at', '<', $endDate);
    }

    public function scopeSearchByEmail($query, ?string $keywords) {

        if(empty($keywords)) {
            return $query;
        }

        return $query->withCount('posts')->having('email', 'regexp', "^{$keywords}+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$");
    }

    public function scopeSort($query, ?string $param) {

        if(empty($param)) {
            return $query;
        } else if($param == 'top') {
            return $query->withCount('posts')->orderBy('posts_count', 'DESC');
        }
    }

    public function scopeAuthors($query, ?string $param) {

        if(empty($param)) {
            return $query;
        } else if($param == 'true') {
            return $query->withCount('posts')->having('posts_count', '>=', 1);
        }
    }

    protected static function boot()
    {
        parent::boot();
        User::saving(function ($model) {
            $model->full_name = $model->first_name." ".$model->last_name;
        });
    }

}
