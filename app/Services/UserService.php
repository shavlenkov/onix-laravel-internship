<?php


namespace App\Services;

use App\Models\Post;
use App\Models\User;

class UserService
{
    public function getUsers($data) {

        [
            'startDate' => $dateInterval['startDate'],
            'endDate' => $dateInterval['endDate'],
            'keywords' => $keywords,
            'sortBy' => $sortBy,
            'authors' => $authors
        ] = $data;

        $users = User::withCount('posts')
            ->dateInterval($startDate, $endDate)
            ->searchByEmail($keywords)
            ->sort($sortBy)
            ->authors($authors)
            ->simplePaginate(config('app.paginate'));

        return $users;
    }

    public function getCountPosts(User $user) {
        return count(Post::where('userId', $user->id)->get());
    }

    public function registerUser($data) {
        $user = User::create($data);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }

    public function loginUser($data) {
        $user = User::where('email', $data['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }


    public function updateUser(User $user, $data) {

        [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
        ] = $data;

        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = $password;

        $user->save();
    }

}
