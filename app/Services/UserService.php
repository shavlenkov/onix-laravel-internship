<?php


namespace App\Services;

use Auth;

use App\Models\Post;
use App\Models\User;

class UserService
{
    public function getUsers($data) {

        [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ] = $data['dateInterval'];

        [
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

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function loginUser($data) {

        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $data['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
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
