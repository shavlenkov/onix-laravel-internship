<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Post;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function profile()
    {
        return auth()->user();
    }

    public function index(Request $request) {

        $users = User::simplePaginate(config('app.paginate'));

        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $keywords = $request->query('keywords');

        if(!empty($startDate) && !empty($endDate) && empty($keywords)) {
            $users = User::where('created_at', '>', $startDate)
                ->where('created_at', '<', $endDate);
        } else if(empty($startDate) && empty($endDate) && !empty($keywords)) {
            $users = User::where('email', 'regexp', "^{$keywords}+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$");
        } else if(!empty($startDate) && !empty($endDate) && !empty($keywords)) {
            $users = User::where('created_at', '>', $startDate)
                ->where('created_at', '<', $endDate)
                ->where('email', 'regexp', "^{$keywords}+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$");
        }

        foreach($users as $user) {
            $user['count_posts'] = count(Post::where('userId', $user->id)->get());
        }

        return $users;
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();

        return response()
            ->json(['success' => true]);

    }

}