<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Post;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function profile()
    {
        return auth()->user();
    }

    public function index(Request $request) {

        $users = User::withCount('posts')->simplePaginate(config('app.paginate'));

        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $keywords = $request->query('keywords');

        $authors = $request->query('authors');
        $sortBy = $request->query('sortBy');

        if(!empty($startDate) && !empty($endDate) && empty($keywords)) {
            $users = User::dateInterval($startDate, $endDate);
        } else if(empty($startDate) && empty($endDate) && !empty($keywords)) {
            $users = User::searchByEmail($keywords);
        } else if(!empty($startDate) && !empty($endDate) && !empty($keywords)) {
            $users = User::dateInterval($startDate, $endDate)->searchByEmail($keywords);
        }

        if($sortBy == 'top') {
            $users = User::sort($sortBy);
        }

        if($authors == 'true') {
            $users = User::authors();
        }

        return UserResource::collection($users);
    }

    public function show(User $user) {
        $user['posts_count'] = count(Post::where('userId', $user->id)->get());

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();

        return response()
            ->json(['success' => true]);
    }

}
