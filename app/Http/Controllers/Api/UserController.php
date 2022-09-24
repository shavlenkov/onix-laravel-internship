<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{

    protected $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function profile()
    {
        return auth()->user();
    }

    public function index(Request $request) {

        $users = $this->userService->getUsers([
            'startDate' => $request->query('startDate'),
            'endDate' => $request->query('endDate'),
            'keywords' => $request->query('keywords'),
            'authors' => $request->query('authors'),
            'sortBy' => $request->query('sortBy'),
        ]);

        return UserResource::collection($users);
    }

    public function show(User $user) {
        $user['posts_count'] = $this->userService->getCountPosts($user);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $this->userService->updateUser($user, $data);

        return response()
            ->json(['success' => true]);
    }


}
