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
        'name',
        'email',
        'password',
    ];

    public function scopeDateInterval($query, $startDate, $endDate) {
        return $query->where('created_at', '>', $startDate)
            ->where('created_at', '<', $endDate);
    }

    public function scopeSearchByEmail($query, $keywords) {
        return $query->where('email', 'regexp', "^{$keywords}+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$");
    }

    public function scopeSort($query, $param) {
        if($param == 'top') {
            return $query->orderBy('count_posts', 'DESC');
        }
    }

    public function scopeAuthors($query) {
        return $builder->where('count_posts', '>=', 1);
    }

}
